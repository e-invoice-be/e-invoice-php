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
use EInvoiceAPI\Validate\ValidateValidateJsonParams;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDParams;
use EInvoiceAPI\Validate\ValidateValidateUblParams;

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
     * }|ValidateValidateJsonParams $params
     */
    public function validateJson(
        array|ValidateValidateJsonParams $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;

    /**
     * @param array{peppolID: string}|ValidateValidatePeppolIDParams $params
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParams $params,
        ?RequestOptions $requestOptions = null,
    ): ValidateValidatePeppolIDResponse;

    /**
     * @param array{file: string}|ValidateValidateUblParams $params
     */
    public function validateUbl(
        array|ValidateValidateUblParams $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;
}
