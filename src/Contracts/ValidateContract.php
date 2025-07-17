<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\CurrencyCode;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\DocumentDirection;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Models\UblDocumentValidation;
use EInvoiceAPI\Parameters\ValidateValidateJsonParam;
use EInvoiceAPI\Parameters\ValidateValidateJsonParam\Item;
use EInvoiceAPI\Parameters\ValidateValidateJsonParam\TaxDetail;
use EInvoiceAPI\Parameters\ValidateValidatePeppolIDParam;
use EInvoiceAPI\Parameters\ValidateValidateUblParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\ValidateValidatePeppolIDResponse;

interface ValidateContract
{
    /**
     * @param ValidateValidateJsonParam|array{
     *   amountDue?: float|string|null,
     *   attachments?: list<DocumentAttachmentCreate>|null,
     *   billingAddress?: string|null,
     *   billingAddressRecipient?: string|null,
     *   currency?: CurrencyCode::*,
     *   customerAddress?: string|null,
     *   customerAddressRecipient?: string|null,
     *   customerEmail?: string|null,
     *   customerID?: string|null,
     *   customerName?: string|null,
     *   customerTaxID?: string|null,
     *   direction?: DocumentDirection::*,
     *   documentType?: DocumentType::*,
     *   dueDate?: \DateTimeInterface|null,
     *   invoiceDate?: \DateTimeInterface|null,
     *   invoiceID?: string|null,
     *   invoiceTotal?: float|string|null,
     *   items?: list<Item>|null,
     *   note?: string|null,
     *   paymentDetails?: list<PaymentDetailCreate>|null,
     *   paymentTerm?: string|null,
     *   previousUnpaidBalance?: float|string|null,
     *   purchaseOrder?: string|null,
     *   remittanceAddress?: string|null,
     *   remittanceAddressRecipient?: string|null,
     *   serviceAddress?: string|null,
     *   serviceAddressRecipient?: string|null,
     *   serviceEndDate?: \DateTimeInterface|null,
     *   serviceStartDate?: \DateTimeInterface|null,
     *   shippingAddress?: string|null,
     *   shippingAddressRecipient?: string|null,
     *   state?: DocumentState::*,
     *   subtotal?: float|string|null,
     *   taxDetails?: list<TaxDetail>|null,
     *   totalDiscount?: float|string|null,
     *   totalTax?: float|string|null,
     *   vendorAddress?: string|null,
     *   vendorAddressRecipient?: string|null,
     *   vendorEmail?: string|null,
     *   vendorName?: string|null,
     *   vendorTaxID?: string|null,
     * } $params
     */
    public function validateJson(
        array|ValidateValidateJsonParam $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;

    /**
     * @param array{peppolID?: string}|ValidateValidatePeppolIDParam $params
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParam $params,
        ?RequestOptions $requestOptions = null,
    ): ValidateValidatePeppolIDResponse;

    /**
     * @param array{file?: string}|ValidateValidateUblParam $params
     */
    public function validateUbl(
        array|ValidateValidateUblParam $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;
}
