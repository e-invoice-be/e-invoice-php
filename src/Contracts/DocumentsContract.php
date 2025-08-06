<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\CurrencyCode;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\DocumentDirection;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Parameters\DocumentCreateParams;
use EInvoiceAPI\Parameters\DocumentCreateParams\Item;
use EInvoiceAPI\Parameters\DocumentCreateParams\TaxDetail;
use EInvoiceAPI\Parameters\DocumentSendParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\DocumentDeleteResponse;

interface DocumentsContract
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
     * }|DocumentCreateParams $params
     */
    public function create(
        array|DocumentCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentDeleteResponse;

    /**
     * @param array{
     *   email?: null|string,
     *   receiverPeppolID?: null|string,
     *   receiverPeppolScheme?: null|string,
     *   senderPeppolID?: null|string,
     *   senderPeppolScheme?: null|string,
     * }|DocumentSendParams $params
     */
    public function send(
        string $documentID,
        array|DocumentSendParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
