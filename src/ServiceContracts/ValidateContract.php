<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Implementation\HasRawResponse;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;

use const EInvoiceAPI\Core\OMIT as omit;

interface ValidateContract
{
    /**
     * @api
     *
     * @param float|string|null $amountDue
     * @param list<DocumentAttachmentCreate>|null $attachments
     * @param string|null $billingAddress
     * @param string|null $billingAddressRecipient
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
     * @param float|string|null $invoiceTotal
     * @param list<Item>|null $items
     * @param string|null $note
     * @param list<PaymentDetailCreate>|null $paymentDetails
     * @param string|null $paymentTerm
     * @param float|string|null $previousUnpaidBalance
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
     * @param float|string|null $subtotal
     * @param list<TaxDetail>|null $taxDetails
     * @param float|string|null $totalDiscount
     * @param float|string|null $totalTax
     * @param string|null $vendorAddress
     * @param string|null $vendorAddressRecipient
     * @param string|null $vendorEmail
     * @param string|null $vendorName
     * @param string|null $vendorTaxID
     *
     * @return UblDocumentValidation<HasRawResponse>
     *
     * @throws APIException
     */
    public function validateJson(
        $amountDue = omit,
        $attachments = omit,
        $billingAddress = omit,
        $billingAddressRecipient = omit,
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
        $taxDetails = omit,
        $totalDiscount = omit,
        $totalTax = omit,
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
     * @return UblDocumentValidation<HasRawResponse>
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
     * @return ValidateValidatePeppolIDResponse<HasRawResponse>
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
     * @return ValidateValidatePeppolIDResponse<HasRawResponse>
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
     * @return UblDocumentValidation<HasRawResponse>
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
     * @return UblDocumentValidation<HasRawResponse>
     *
     * @throws APIException
     */
    public function validateUblRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation;
}
