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
     * @param array{
     *   amountDue?: null|float|string,
     *   attachments?: null|list<DocumentAttachmentCreate>,
     *   billingAddress?: null|string,
     *   billingAddressRecipient?: null|string,
     *   currency?: CurrencyCode::*,
     *   customerAddress?: null|string,
     *   customerAddressRecipient?: null|string,
     *   customerEmail?: null|string,
     *   customerID?: null|string,
     *   customerName?: null|string,
     *   customerTaxID?: null|string,
     *   direction?: DocumentDirection::*,
     *   documentType?: DocumentType::*,
     *   dueDate?: null|\DateTimeInterface,
     *   invoiceDate?: null|\DateTimeInterface,
     *   invoiceID?: null|string,
     *   invoiceTotal?: null|float|string,
     *   items?: null|list<Item>,
     *   note?: null|string,
     *   paymentDetails?: null|list<PaymentDetailCreate>,
     *   paymentTerm?: null|string,
     *   previousUnpaidBalance?: null|float|string,
     *   purchaseOrder?: null|string,
     *   remittanceAddress?: null|string,
     *   remittanceAddressRecipient?: null|string,
     *   serviceAddress?: null|string,
     *   serviceAddressRecipient?: null|string,
     *   serviceEndDate?: null|\DateTimeInterface,
     *   serviceStartDate?: null|\DateTimeInterface,
     *   shippingAddress?: null|string,
     *   shippingAddressRecipient?: null|string,
     *   state?: DocumentState::*,
     *   subtotal?: null|float|string,
     *   taxDetails?: null|list<TaxDetail>,
     *   totalDiscount?: null|float|string,
     *   totalTax?: null|float|string,
     *   vendorAddress?: null|string,
     *   vendorAddressRecipient?: null|string,
     *   vendorEmail?: null|string,
     *   vendorName?: null|string,
     *   vendorTaxID?: null|string,
     * }|ValidateValidateJsonParam $params
     */
    public function validateJson(
        array|ValidateValidateJsonParam $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;

    /**
     * @param array{peppolID: string}|ValidateValidatePeppolIDParam $params
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParam $params,
        ?RequestOptions $requestOptions = null,
    ): ValidateValidatePeppolIDResponse;

    /**
     * @param array{file: string}|ValidateValidateUblParam $params
     */
    public function validateUbl(
        array|ValidateValidateUblParam $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;
}
