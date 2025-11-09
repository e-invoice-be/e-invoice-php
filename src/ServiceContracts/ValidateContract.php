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

use const EInvoiceAPI\Core\OMIT as omit;

interface ValidateContract
{
    /**
     * @api
     *
     * @param list<Allowance>|null $allowances
     * @param float|string|null $amountDue The amount due for payment. Must be positive and rounded to maximum 2 decimals
     * @param list<DocumentAttachmentCreate>|null $attachments
     * @param string|null $billingAddress The billing address (if different from customer address)
     * @param string|null $billingAddressRecipient The recipient name at the billing address
     * @param list<Charge>|null $charges
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
     * @param \DateTimeInterface|null $dueDate The date when payment is due
     * @param \DateTimeInterface|null $invoiceDate The date when the invoice was issued
     * @param string|null $invoiceID The unique invoice identifier/number
     * @param float|string|null $invoiceTotal The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals
     * @param list<Item> $items At least one line item is required
     * @param string|null $note Additional notes or comments for the invoice
     * @param list<PaymentDetailCreate>|null $paymentDetails
     * @param string|null $paymentTerm The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30')
     * @param float|string|null $previousUnpaidBalance The previous unpaid balance from prior invoices, if any. Must be positive and rounded to maximum 2 decimals
     * @param string|null $purchaseOrder The purchase order reference number
     * @param string|null $remittanceAddress The address where payment should be sent or remitted to
     * @param string|null $remittanceAddressRecipient The recipient name at the remittance address
     * @param string|null $serviceAddress The address where services were performed or goods were delivered
     * @param string|null $serviceAddressRecipient The recipient name at the service address
     * @param \DateTimeInterface|null $serviceEndDate The end date of the service period or delivery period
     * @param \DateTimeInterface|null $serviceStartDate The start date of the service period or delivery period
     * @param string|null $shippingAddress The shipping/delivery address
     * @param string|null $shippingAddressRecipient The recipient name at the shipping address
     * @param DocumentState|value-of<DocumentState> $state The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED
     * @param float|string|null $subtotal The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals
     * @param TaxCode|value-of<TaxCode> $taxCode Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt)
     * @param list<TaxDetail>|null $taxDetails
     * @param float|string|null $totalDiscount The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals
     * @param float|string|null $totalTax The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals
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
     *
     * @throws APIException
     */
    public function validateJson(
        $allowances = omit,
        $amountDue = omit,
        $attachments = omit,
        $billingAddress = omit,
        $billingAddressRecipient = omit,
        $charges = omit,
        $currency = omit,
        $customerAddress = omit,
        $customerAddressRecipient = omit,
        $customerCompanyID = omit,
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
        $vendorCompanyID = omit,
        $vendorEmail = omit,
        $vendorName = omit,
        $vendorTaxID = omit,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function validateJsonRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation;

    /**
     * @api
     *
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     *
     * @throws APIException
     */
    public function validatePeppolID(
        $peppolID,
        ?RequestOptions $requestOptions = null
    ): ValidateValidatePeppolIDResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function validatePeppolIDRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): ValidateValidatePeppolIDResponse;

    /**
     * @api
     *
     * @param string $file
     *
     * @throws APIException
     */
    public function validateUbl(
        $file,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function validateUblRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation;
}
