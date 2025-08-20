<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Validate\ValidateValidatePeppolIDResponse;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail;

interface ValidateContract
{
    /**
     * @param null|float|string $amountDue
     * @param null|list<DocumentAttachmentCreate> $attachments
     * @param null|string $billingAddress
     * @param null|string $billingAddressRecipient
     * @param CurrencyCode::* $currency Currency of the invoice
     * @param null|string $customerAddress
     * @param null|string $customerAddressRecipient
     * @param null|string $customerEmail
     * @param null|string $customerID
     * @param null|string $customerName
     * @param null|string $customerTaxID
     * @param DocumentDirection::* $direction
     * @param DocumentType::* $documentType
     * @param null|\DateTimeInterface $dueDate
     * @param null|\DateTimeInterface $invoiceDate
     * @param null|string $invoiceID
     * @param null|float|string $invoiceTotal
     * @param null|list<Item> $items
     * @param null|string $note
     * @param null|list<PaymentDetailCreate> $paymentDetails
     * @param null|string $paymentTerm
     * @param null|float|string $previousUnpaidBalance
     * @param null|string $purchaseOrder
     * @param null|string $remittanceAddress
     * @param null|string $remittanceAddressRecipient
     * @param null|string $serviceAddress
     * @param null|string $serviceAddressRecipient
     * @param null|\DateTimeInterface $serviceEndDate
     * @param null|\DateTimeInterface $serviceStartDate
     * @param null|string $shippingAddress
     * @param null|string $shippingAddressRecipient
     * @param DocumentState::* $state
     * @param null|float|string $subtotal
     * @param null|list<TaxDetail> $taxDetails
     * @param null|float|string $totalDiscount
     * @param null|float|string $totalTax
     * @param null|string $vendorAddress
     * @param null|string $vendorAddressRecipient
     * @param null|string $vendorEmail
     * @param null|string $vendorName
     * @param null|string $vendorTaxID
     */
    public function validateJson(
        $amountDue = null,
        $attachments = null,
        $billingAddress = null,
        $billingAddressRecipient = null,
        $currency = null,
        $customerAddress = null,
        $customerAddressRecipient = null,
        $customerEmail = null,
        $customerID = null,
        $customerName = null,
        $customerTaxID = null,
        $direction = null,
        $documentType = null,
        $dueDate = null,
        $invoiceDate = null,
        $invoiceID = null,
        $invoiceTotal = null,
        $items = null,
        $note = null,
        $paymentDetails = null,
        $paymentTerm = null,
        $previousUnpaidBalance = null,
        $purchaseOrder = null,
        $remittanceAddress = null,
        $remittanceAddressRecipient = null,
        $serviceAddress = null,
        $serviceAddressRecipient = null,
        $serviceEndDate = null,
        $serviceStartDate = null,
        $shippingAddress = null,
        $shippingAddressRecipient = null,
        $state = null,
        $subtotal = null,
        $taxDetails = null,
        $totalDiscount = null,
        $totalTax = null,
        $vendorAddress = null,
        $vendorAddressRecipient = null,
        $vendorEmail = null,
        $vendorName = null,
        $vendorTaxID = null,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;

    /**
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    public function validatePeppolID(
        $peppolID,
        ?RequestOptions $requestOptions = null
    ): ValidateValidatePeppolIDResponse;

    /**
     * @param string $file
     */
    public function validateUbl(
        $file,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation;
}
