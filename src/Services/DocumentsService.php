<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance;
use EInvoiceAPI\Documents\DocumentCreateParams\Charge;
use EInvoiceAPI\Documents\DocumentCreateParams\Item;
use EInvoiceAPI\Documents\DocumentCreateParams\TaxCode;
use EInvoiceAPI\Documents\DocumentCreateParams\TaxDetail;
use EInvoiceAPI\Documents\DocumentCreateParams\Vatex;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\DocumentsContract;
use EInvoiceAPI\Services\Documents\AttachmentsService;
use EInvoiceAPI\Services\Documents\UblService;
use EInvoiceAPI\Validate\UblDocumentValidation;

/**
 * @phpstan-import-type AllowanceShape from \EInvoiceAPI\Documents\DocumentCreateParams\Allowance
 * @phpstan-import-type AmountDueShape from \EInvoiceAPI\Documents\DocumentCreateParams\AmountDue
 * @phpstan-import-type DocumentAttachmentCreateShape from \EInvoiceAPI\Documents\DocumentAttachmentCreate
 * @phpstan-import-type ChargeShape from \EInvoiceAPI\Documents\DocumentCreateParams\Charge
 * @phpstan-import-type InvoiceTotalShape from \EInvoiceAPI\Documents\DocumentCreateParams\InvoiceTotal
 * @phpstan-import-type ItemShape from \EInvoiceAPI\Documents\DocumentCreateParams\Item
 * @phpstan-import-type PaymentDetailCreateShape from \EInvoiceAPI\Documents\PaymentDetailCreate
 * @phpstan-import-type PreviousUnpaidBalanceShape from \EInvoiceAPI\Documents\DocumentCreateParams\PreviousUnpaidBalance
 * @phpstan-import-type SubtotalShape from \EInvoiceAPI\Documents\DocumentCreateParams\Subtotal
 * @phpstan-import-type TaxDetailShape from \EInvoiceAPI\Documents\DocumentCreateParams\TaxDetail
 * @phpstan-import-type TotalDiscountShape from \EInvoiceAPI\Documents\DocumentCreateParams\TotalDiscount
 * @phpstan-import-type TotalTaxShape from \EInvoiceAPI\Documents\DocumentCreateParams\TotalTax
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class DocumentsService implements DocumentsContract
{
    /**
     * @api
     */
    public DocumentsRawService $raw;

    /**
     * @api
     */
    public AttachmentsService $attachments;

    /**
     * @api
     */
    public UblService $ubl;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DocumentsRawService($client);
        $this->attachments = new AttachmentsService($client);
        $this->ubl = new UblService($client);
    }

    /**
     * @api
     *
     * Create a new invoice or credit note
     *
     * @param bool $constructPdf query param: If true, generate a constructed PDF from the document and include it both as document attachment and embedded in the UBL
     * @param list<Allowance|AllowanceShape>|null $allowances Body param
     * @param AmountDueShape|null $amountDue Body param: The amount due for payment. Must be positive and rounded to maximum 2 decimals
     * @param list<DocumentAttachmentCreate|DocumentAttachmentCreateShape>|null $attachments Body param
     * @param string|null $billingAddress Body param: The billing address (if different from customer address)
     * @param string|null $billingAddressRecipient Body param: The recipient name at the billing address
     * @param list<Charge|ChargeShape>|null $charges Body param
     * @param CurrencyCode|value-of<CurrencyCode> $currency Body param: Currency of the invoice (ISO 4217 currency code)
     * @param string|null $customerAddress Body param: The address of the customer/buyer
     * @param string|null $customerAddressRecipient Body param: The recipient name at the customer address
     * @param string|null $customerCompanyID Body param: Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $customerEmail Body param: The email address of the customer
     * @param string|null $customerID Body param: The unique identifier for the customer in your system
     * @param string|null $customerName Body param: The company name of the customer/buyer
     * @param string|null $customerPeppolID Body param: Customer Peppol ID
     * @param string|null $customerTaxID Body param: Customer tax ID. For Belgium this is the VAT number. Must include the country prefix
     * @param DocumentDirection|value-of<DocumentDirection> $direction Body param: The direction of the document: INBOUND (purchases) or OUTBOUND (sales)
     * @param DocumentType|value-of<DocumentType> $documentType Body param: The type of document: INVOICE, CREDIT_NOTE, or DEBIT_NOTE
     * @param string|null $dueDate Body param: The date when payment is due
     * @param string|null $invoiceDate Body param: The date when the invoice was issued
     * @param string|null $invoiceID Body param: The unique invoice identifier/number
     * @param InvoiceTotalShape|null $invoiceTotal Body param: The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals
     * @param list<Item|ItemShape> $items Body param: At least one line item is required
     * @param string|null $note Body param: Additional notes or comments for the invoice
     * @param list<PaymentDetailCreate|PaymentDetailCreateShape>|null $paymentDetails Body param
     * @param string|null $paymentTerm Body param: The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30')
     * @param PreviousUnpaidBalanceShape|null $previousUnpaidBalance Body param: The previous unpaid balance from prior invoices, if any. Must be positive and rounded to maximum 2 decimals
     * @param string|null $purchaseOrder Body param: The purchase order reference number
     * @param string|null $remittanceAddress Body param: The address where payment should be sent or remitted to
     * @param string|null $remittanceAddressRecipient Body param: The recipient name at the remittance address
     * @param string|null $serviceAddress Body param: The address where services were performed or goods were delivered
     * @param string|null $serviceAddressRecipient Body param: The recipient name at the service address
     * @param string|null $serviceEndDate Body param: The end date of the service period or delivery period
     * @param string|null $serviceStartDate Body param: The start date of the service period or delivery period
     * @param string|null $shippingAddress Body param: The shipping/delivery address
     * @param string|null $shippingAddressRecipient Body param: The recipient name at the shipping address
     * @param DocumentState|value-of<DocumentState> $state Body param: The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED
     * @param SubtotalShape|null $subtotal Body param: The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals
     * @param TaxCode|value-of<TaxCode> $taxCode Body param: Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt)
     * @param list<TaxDetail|TaxDetailShape>|null $taxDetails Body param
     * @param TotalDiscountShape|null $totalDiscount Body param: The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals
     * @param TotalTaxShape|null $totalTax Body param: The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals
     * @param Vatex|value-of<Vatex>|null $vatex Body param: VATEX code list for VAT exemption reasons
     *
     * Agency: CEF
     * Identifier: vatex
     * @param string|null $vatexNote Body param: Textual explanation for VAT exemption
     * @param string|null $vendorAddress Body param: The address of the vendor/seller
     * @param string|null $vendorAddressRecipient Body param: The recipient name at the vendor address
     * @param string|null $vendorCompanyID Body param: Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $vendorEmail Body param: The email address of the vendor
     * @param string|null $vendorName Body param: The name of the vendor/seller/supplier
     * @param string|null $vendorTaxID Body param: Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        bool $constructPdf = false,
        ?array $allowances = null,
        float|string|null $amountDue = null,
        ?array $attachments = null,
        ?string $billingAddress = null,
        ?string $billingAddressRecipient = null,
        ?array $charges = null,
        CurrencyCode|string|null $currency = null,
        ?string $customerAddress = null,
        ?string $customerAddressRecipient = null,
        ?string $customerCompanyID = null,
        ?string $customerEmail = null,
        ?string $customerID = null,
        ?string $customerName = null,
        ?string $customerPeppolID = null,
        ?string $customerTaxID = null,
        DocumentDirection|string|null $direction = null,
        DocumentType|string|null $documentType = null,
        ?string $dueDate = null,
        ?string $invoiceDate = null,
        ?string $invoiceID = null,
        float|string|null $invoiceTotal = null,
        ?array $items = null,
        ?string $note = null,
        ?array $paymentDetails = null,
        ?string $paymentTerm = null,
        float|string|null $previousUnpaidBalance = null,
        ?string $purchaseOrder = null,
        ?string $remittanceAddress = null,
        ?string $remittanceAddressRecipient = null,
        ?string $serviceAddress = null,
        ?string $serviceAddressRecipient = null,
        ?string $serviceEndDate = null,
        ?string $serviceStartDate = null,
        ?string $shippingAddress = null,
        ?string $shippingAddressRecipient = null,
        DocumentState|string|null $state = null,
        float|string|null $subtotal = null,
        TaxCode|string $taxCode = 'S',
        ?array $taxDetails = null,
        float|string|null $totalDiscount = null,
        float|string|null $totalTax = null,
        Vatex|string|null $vatex = null,
        ?string $vatexNote = null,
        ?string $vendorAddress = null,
        ?string $vendorAddressRecipient = null,
        ?string $vendorCompanyID = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorTaxID = null,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentResponse {
        $params = Util::removeNulls(
            [
                'constructPdf' => $constructPdf,
                'allowances' => $allowances,
                'amountDue' => $amountDue,
                'attachments' => $attachments,
                'billingAddress' => $billingAddress,
                'billingAddressRecipient' => $billingAddressRecipient,
                'charges' => $charges,
                'currency' => $currency,
                'customerAddress' => $customerAddress,
                'customerAddressRecipient' => $customerAddressRecipient,
                'customerCompanyID' => $customerCompanyID,
                'customerEmail' => $customerEmail,
                'customerID' => $customerID,
                'customerName' => $customerName,
                'customerPeppolID' => $customerPeppolID,
                'customerTaxID' => $customerTaxID,
                'direction' => $direction,
                'documentType' => $documentType,
                'dueDate' => $dueDate,
                'invoiceDate' => $invoiceDate,
                'invoiceID' => $invoiceID,
                'invoiceTotal' => $invoiceTotal,
                'items' => $items,
                'note' => $note,
                'paymentDetails' => $paymentDetails,
                'paymentTerm' => $paymentTerm,
                'previousUnpaidBalance' => $previousUnpaidBalance,
                'purchaseOrder' => $purchaseOrder,
                'remittanceAddress' => $remittanceAddress,
                'remittanceAddressRecipient' => $remittanceAddressRecipient,
                'serviceAddress' => $serviceAddress,
                'serviceAddressRecipient' => $serviceAddressRecipient,
                'serviceEndDate' => $serviceEndDate,
                'serviceStartDate' => $serviceStartDate,
                'shippingAddress' => $shippingAddress,
                'shippingAddressRecipient' => $shippingAddressRecipient,
                'state' => $state,
                'subtotal' => $subtotal,
                'taxCode' => $taxCode,
                'taxDetails' => $taxDetails,
                'totalDiscount' => $totalDiscount,
                'totalTax' => $totalTax,
                'vatex' => $vatex,
                'vatexNote' => $vatexNote,
                'vendorAddress' => $vendorAddress,
                'vendorAddressRecipient' => $vendorAddressRecipient,
                'vendorCompanyID' => $vendorCompanyID,
                'vendorEmail' => $vendorEmail,
                'vendorName' => $vendorName,
                'vendorTaxID' => $vendorTaxID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get an invoice or credit note by ID
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): DocumentResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an invoice or credit note
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): DocumentDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
     *
     * @param string $file Body param
     * @param string|null $customerTaxID Query param
     * @param string|null $vendorTaxID Query param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createFromPdf(
        string $file,
        ?string $customerTaxID = null,
        ?string $vendorTaxID = null,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentNewFromPdfResponse {
        $params = Util::removeNulls(
            [
                'file' => $file,
                'customerTaxID' => $customerTaxID,
                'vendorTaxID' => $vendorTaxID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createFromPdf(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send an invoice or credit note via Peppol. By default, the sender and receiver Peppol IDs are derived from the company (tax) IDs in the document, regardless of whether the document was created from a UBL with a different endpoint ID. To explicitly set the sender or receiver Peppol ID, provide them via the query parameters (sender_peppol_scheme, sender_peppol_id, receiver_peppol_scheme, receiver_peppol_id).
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        ?string $email = null,
        ?string $receiverPeppolID = null,
        ?string $receiverPeppolScheme = null,
        ?string $senderPeppolID = null,
        ?string $senderPeppolScheme = null,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentResponse {
        $params = Util::removeNulls(
            [
                'email' => $email,
                'receiverPeppolID' => $receiverPeppolID,
                'receiverPeppolScheme' => $receiverPeppolScheme,
                'senderPeppolID' => $senderPeppolID,
                'senderPeppolScheme' => $senderPeppolScheme,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->send($documentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Validate a UBL document according to Peppol BIS Billing 3.0
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): UblDocumentValidation {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->validate($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
