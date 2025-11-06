<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentCreateFromPdfParams;
use EInvoiceAPI\Documents\DocumentCreateParams;
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
use EInvoiceAPI\Documents\DocumentSendParams;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\DocumentsContract;
use EInvoiceAPI\Services\Documents\AttachmentsService;
use EInvoiceAPI\Services\Documents\UblService;
use EInvoiceAPI\Validate\UblDocumentValidation;

use const EInvoiceAPI\Core\OMIT as omit;

final class DocumentsService implements DocumentsContract
{
    /**
     * @@api
     */
    public AttachmentsService $attachments;

    /**
     * @@api
     */
    public UblService $ubl;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->attachments = new AttachmentsService($client);
        $this->ubl = new UblService($client);
    }

    /**
     * @api
     *
     * Create a new invoice or credit note
     *
     * @param list<Allowance>|null $allowances
     * @param float|string|null $amountDue The amount due of the invoice. Must be positive and rounded to maximum 2 decimals
     * @param list<DocumentAttachmentCreate>|null $attachments
     * @param string|null $billingAddress
     * @param string|null $billingAddressRecipient
     * @param list<Charge>|null $charges
     * @param CurrencyCode|value-of<CurrencyCode> $currency Currency of the invoice
     * @param string|null $customerAddress
     * @param string|null $customerAddressRecipient
     * @param string|null $customerEmail
     * @param string|null $customerID
     * @param string|null $customerName
     * @param string|null $customerTaxID
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     * @param DocumentType|value-of<DocumentType> $documentType
     * @param \DateTimeInterface|null $dueDate
     * @param \DateTimeInterface|null $invoiceDate
     * @param string|null $invoiceID
     * @param float|string|null $invoiceTotal The total amount of the invoice (so invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals
     * @param list<Item> $items At least one line item is required
     * @param string|null $note
     * @param list<PaymentDetailCreate>|null $paymentDetails
     * @param string|null $paymentTerm
     * @param float|string|null $previousUnpaidBalance The previous unpaid balance of the invoice, if any. Must be positive and rounded to maximum 2 decimals
     * @param string|null $purchaseOrder
     * @param string|null $remittanceAddress
     * @param string|null $remittanceAddressRecipient
     * @param string|null $serviceAddress
     * @param string|null $serviceAddressRecipient
     * @param \DateTimeInterface|null $serviceEndDate
     * @param \DateTimeInterface|null $serviceStartDate
     * @param string|null $shippingAddress
     * @param string|null $shippingAddressRecipient
     * @param DocumentState|value-of<DocumentState> $state
     * @param float|string|null $subtotal The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals
     * @param TaxCode|value-of<TaxCode> $taxCode Tax category code of the invoice
     * @param list<TaxDetail>|null $taxDetails
     * @param float|string|null $totalDiscount The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals
     * @param float|string|null $totalTax The total tax of the invoice. Must be positive and rounded to maximum 2 decimals
     * @param Vatex|value-of<Vatex>|null $vatex VATEX code list for VAT exemption reasons
     *
     * Agency: CEF
     * Identifier: vatex
     * @param string|null $vatexNote VAT exemption note of the invoice
     * @param string|null $vendorAddress
     * @param string|null $vendorAddressRecipient
     * @param string|null $vendorEmail
     * @param string|null $vendorName
     * @param string|null $vendorTaxID
     *
     * @throws APIException
     */
    public function create(
        $allowances = omit,
        $amountDue = omit,
        $attachments = omit,
        $billingAddress = omit,
        $billingAddressRecipient = omit,
        $charges = omit,
        $currency = omit,
        $customerAddress = omit,
        $customerAddressRecipient = omit,
        $customerEmail = omit,
        $customerID = omit,
        $customerName = omit,
        $customerTaxID = omit,
        $direction = omit,
        $documentType = omit,
        $dueDate = omit,
        $invoiceDate = omit,
        $invoiceID = omit,
        $invoiceTotal = omit,
        $items = omit,
        $note = omit,
        $paymentDetails = omit,
        $paymentTerm = omit,
        $previousUnpaidBalance = omit,
        $purchaseOrder = omit,
        $remittanceAddress = omit,
        $remittanceAddressRecipient = omit,
        $serviceAddress = omit,
        $serviceAddressRecipient = omit,
        $serviceEndDate = omit,
        $serviceStartDate = omit,
        $shippingAddress = omit,
        $shippingAddressRecipient = omit,
        $state = omit,
        $subtotal = omit,
        $taxCode = omit,
        $taxDetails = omit,
        $totalDiscount = omit,
        $totalTax = omit,
        $vatex = omit,
        $vatexNote = omit,
        $vendorAddress = omit,
        $vendorAddressRecipient = omit,
        $vendorEmail = omit,
        $vendorName = omit,
        $vendorTaxID = omit,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        $params = [
            'allowances' => $allowances,
            'amountDue' => $amountDue,
            'attachments' => $attachments,
            'billingAddress' => $billingAddress,
            'billingAddressRecipient' => $billingAddressRecipient,
            'charges' => $charges,
            'currency' => $currency,
            'customerAddress' => $customerAddress,
            'customerAddressRecipient' => $customerAddressRecipient,
            'customerEmail' => $customerEmail,
            'customerID' => $customerID,
            'customerName' => $customerName,
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
            'vendorEmail' => $vendorEmail,
            'vendorName' => $vendorName,
            'vendorTaxID' => $vendorTaxID,
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = DocumentCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'api/documents/',
            body: (object) $parsed,
            options: $options,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Get an invoice or credit note by ID
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete an invoice or credit note
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentDeleteResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
     *
     * @param string $file
     * @param string|null $customerTaxID
     * @param string|null $vendorTaxID
     *
     * @throws APIException
     */
    public function createFromPdf(
        $file,
        $customerTaxID = omit,
        $vendorTaxID = omit,
        ?RequestOptions $requestOptions = null,
    ): DocumentNewFromPdfResponse {
        $params = [
            'file' => $file,
            'customerTaxID' => $customerTaxID,
            'vendorTaxID' => $vendorTaxID,
        ];

        return $this->createFromPdfRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createFromPdfRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentNewFromPdfResponse {
        [$parsed, $options] = DocumentCreateFromPdfParams::parseRequest(
            $params,
            $requestOptions
        );
        $query_params = array_flip(['customer_tax_id', 'vendor_tax_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'api/documents/pdf',
            query: array_diff_key($parsed, $query_params),
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: DocumentNewFromPdfResponse::class,
        );
    }

    /**
     * @api
     *
     * Send an invoice or credit note via Peppol
     *
     * @param string|null $email
     * @param string|null $receiverPeppolID
     * @param string|null $receiverPeppolScheme
     * @param string|null $senderPeppolID
     * @param string|null $senderPeppolScheme
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        $email = omit,
        $receiverPeppolID = omit,
        $receiverPeppolScheme = omit,
        $senderPeppolID = omit,
        $senderPeppolScheme = omit,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        $params = [
            'email' => $email,
            'receiverPeppolID' => $receiverPeppolID,
            'receiverPeppolScheme' => $receiverPeppolScheme,
            'senderPeppolID' => $senderPeppolID,
            'senderPeppolScheme' => $senderPeppolScheme,
        ];

        return $this->sendRaw($documentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function sendRaw(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = DocumentSendParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Validate a UBL document according to Peppol BIS Billing 3.0
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/validate', $documentID],
            options: $requestOptions,
            convert: UblDocumentValidation::class,
        );
    }
}
