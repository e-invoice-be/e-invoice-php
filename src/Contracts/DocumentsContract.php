<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DeleteResponse;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Parameters\Documents\CreateParams\Item;
use EInvoiceAPI\Parameters\Documents\CreateParams\TaxDetail;
use EInvoiceAPI\RequestOptions;

interface DocumentsContract
{
    /**
     * @param array{
     *   amountDue?: float|string|null,
     *   attachments?: list<DocumentAttachmentCreate>|null,
     *   billingAddress?: string|null,
     *   billingAddressRecipient?: string|null,
     *   currency?: string,
     *   customerAddress?: string|null,
     *   customerAddressRecipient?: string|null,
     *   customerEmail?: string|null,
     *   customerID?: string|null,
     *   customerName?: string|null,
     *   customerTaxID?: string|null,
     *   direction?: string,
     *   documentType?: string,
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
     *   state?: string,
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
    public function create(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @param array{documentID?: string} $params
     */
    public function retrieve(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @param array{documentID?: string} $params
     */
    public function delete(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DeleteResponse;

    /**
     * @param array{
     *   documentID?: string,
     *   email?: string|null,
     *   receiverPeppolID?: string|null,
     *   receiverPeppolScheme?: string|null,
     *   senderPeppolID?: string|null,
     *   senderPeppolScheme?: string|null,
     * } $params
     */
    public function send(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
