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
