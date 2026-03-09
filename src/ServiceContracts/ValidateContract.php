<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Allowance;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Charge;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxCode;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Vatex;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;

/**
 * @phpstan-import-type AllowanceShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Allowance
 * @phpstan-import-type AmountDueShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\AmountDue
 * @phpstan-import-type DocumentAttachmentCreateShape from \EInvoiceAPI\Documents\DocumentAttachmentCreate
 * @phpstan-import-type ChargeShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Charge
 * @phpstan-import-type InvoiceTotalShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\InvoiceTotal
 * @phpstan-import-type ItemShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item
 * @phpstan-import-type PaymentDetailCreateShape from \EInvoiceAPI\Documents\PaymentDetailCreate
 * @phpstan-import-type PreviousUnpaidBalanceShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\PreviousUnpaidBalance
 * @phpstan-import-type SubtotalShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Subtotal
 * @phpstan-import-type TaxDetailShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail
 * @phpstan-import-type TotalDiscountShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\TotalDiscount
 * @phpstan-import-type TotalTaxShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\TotalTax
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface ValidateContract
{
    /**
     * @api
     *
     * @param list<Allowance|AllowanceShape>|null $allowances
     * @param AmountDueShape|null $amountDue The amount due for payment. Must be positive and rounded to maximum 2 decimals
     * @param list<DocumentAttachmentCreate|DocumentAttachmentCreateShape>|null $attachments
     * @param string|null $billingAddress The billing address (if different from customer address)
     * @param string|null $billingAddressRecipient The recipient name at the billing address
     * @param list<Charge|ChargeShape>|null $charges
     * @param CurrencyCode|value-of<CurrencyCode> $currency Currency of the invoice (ISO 4217 currency code)
     * @param string|null $customerAddress The address of the customer/buyer
     * @param string|null $customerAddressRecipient The recipient name at the customer address
     * @param string|null $customerCompanyID Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $customerEmail The email address of the customer
     * @param string|null $customerID The unique identifier for the customer in your system
     * @param string|null $customerName The company name of the customer/buyer
     * @param string|null $customerTaxID Customer tax ID. For Belgium this is the VAT number. Must include the country prefix
     * @param DocumentDirection|value-of<DocumentDirection> $direction The direction of the document: INBOUND (purchases) or OUTBOUND (sales)
     * @param DocumentType|value-of<DocumentType> $documentType The type of document: INVOICE, CREDIT_NOTE, or DEBIT_NOTE
     * @param string|null $dueDate The date when payment is due
     * @param string|null $invoiceDate The date when the invoice was issued
     * @param string|null $invoiceID The unique invoice identifier/number
     * @param InvoiceTotalShape|null $invoiceTotal The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals
     * @param list<Item|ItemShape> $items At least one line item is required
     * @param string|null $note Additional notes or comments for the invoice
     * @param list<PaymentDetailCreate|PaymentDetailCreateShape>|null $paymentDetails
     * @param string|null $paymentTerm The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30')
     * @param PreviousUnpaidBalanceShape|null $previousUnpaidBalance The previous unpaid balance from prior invoices, if any. Must be positive and rounded to maximum 2 decimals
     * @param string|null $purchaseOrder The purchase order reference number
     * @param string|null $remittanceAddress The address where payment should be sent or remitted to
     * @param string|null $remittanceAddressRecipient The recipient name at the remittance address
     * @param string|null $serviceAddress The address where services were performed or goods were delivered
     * @param string|null $serviceAddressRecipient The recipient name at the service address
     * @param string|null $serviceEndDate The end date of the service period or delivery period
     * @param string|null $serviceStartDate The start date of the service period or delivery period
     * @param string|null $shippingAddress The shipping/delivery address
     * @param string|null $shippingAddressRecipient The recipient name at the shipping address
     * @param DocumentState|value-of<DocumentState> $state The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED
     * @param SubtotalShape|null $subtotal The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals
     * @param TaxCode|value-of<TaxCode> $taxCode Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt)
     * @param list<TaxDetail|TaxDetailShape>|null $taxDetails
     * @param TotalDiscountShape|null $totalDiscount The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals
     * @param TotalTaxShape|null $totalTax The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals
     * @param Vatex|value-of<Vatex>|null $vatex VATEX code list for VAT exemption reasons
     *
     * Agency: CEF
     * Identifier: vatex
     * @param string|null $vatexNote Textual explanation for VAT exemption
     * @param string|null $vendorAddress The address of the vendor/seller
     * @param string|null $vendorAddressRecipient The recipient name at the vendor address
     * @param string|null $vendorCompanyID Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $vendorEmail The email address of the vendor
     * @param string|null $vendorName The name of the vendor/seller/supplier
     * @param string|null $vendorTaxID Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validateJson(
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
    ): UblDocumentValidation;

    /**
     * @api
     *
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validatePeppolID(
        string $peppolID,
        RequestOptions|array|null $requestOptions = null
    ): ValidateValidatePeppolIDResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validateUbl(
        string $file,
        RequestOptions|array|null $requestOptions = null
    ): UblDocumentValidation;
}
