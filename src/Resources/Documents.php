<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\DocumentsContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\CurrencyCode;
use EInvoiceAPI\Models\DeleteResponse;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\DocumentDirection;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Parameters\DocumentCreateParam;
use EInvoiceAPI\Parameters\DocumentCreateParam\Item;
use EInvoiceAPI\Parameters\DocumentCreateParam\TaxDetail;
use EInvoiceAPI\Parameters\DocumentSendParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Resources\Documents\Attachments;
use EInvoiceAPI\Resources\Documents\Ubl;

final class Documents implements DocumentsContract
{
    public Attachments $attachments;

    public Ubl $ubl;

    public function __construct(private Client $client)
    {
        $this->attachments = new Attachments($this->client);
        $this->ubl = new Ubl($this->client);
    }

    /**
     * @param DocumentCreateParam|array{
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
    public function create(
        array|DocumentCreateParam $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = DocumentCreateParam::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'api/documents/',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DeleteResponse {
        $resp = $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DeleteResponse::class, value: $resp);
    }

    /**
     * @param DocumentSendParam|array{
     *   email?: string|null,
     *   receiverPeppolID?: string|null,
     *   receiverPeppolScheme?: string|null,
     *   senderPeppolID?: string|null,
     *   senderPeppolScheme?: string|null,
     * } $params
     */
    public function send(
        string $documentID,
        array|DocumentSendParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = DocumentSendParam::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }
}
