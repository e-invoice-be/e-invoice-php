<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\DocumentsContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DeleteResponse;
use EInvoiceAPI\Parameters\Documents\CreateParams;
use EInvoiceAPI\Parameters\Documents\SendParams;
use EInvoiceAPI\Resources\Documents\Attachments;
use EInvoiceAPI\Resources\Documents\Ubl;

class Documents implements DocumentsContract
{
    public Attachments $attachments;

    public Ubl $ubl;

    /**
     * @param array{
     *
     *     amountDue?: float|string|null,
     *     attachments?: list<DocumentAttachmentCreate>|null,
     *     billingAddress?: string|null,
     *     billingAddressRecipient?: string|null,
     *     currency?: string,
     *     customerAddress?: string|null,
     *     customerAddressRecipient?: string|null,
     *     customerEmail?: string|null,
     *     customerID?: string|null,
     *     customerName?: string|null,
     *     customerTaxID?: string|null,
     *     direction?: string,
     *     documentType?: string,
     *     dueDate?: mixed|null,
     *     invoiceDate?: mixed|null,
     *     invoiceID?: string|null,
     *     invoiceTotal?: float|string|null,
     *     items?: list<array{
     *
     *         amount?: float|string|null,
     *         date?: mixed|null,
     *         description?: string|null,
     *         productCode?: string|null,
     *         quantity?: float|string|null,
     *         tax?: float|string|null,
     *         taxRate?: string|null,
     *         unit?: string,
     *         unitPrice?: float|string|null,
     *
     * }>|null,
     *     note?: string|null,
     *     paymentDetails?: list<PaymentDetailCreate>|null,
     *     paymentTerm?: string|null,
     *     previousUnpaidBalance?: float|string|null,
     *     purchaseOrder?: string|null,
     *     remittanceAddress?: string|null,
     *     remittanceAddressRecipient?: string|null,
     *     serviceAddress?: string|null,
     *     serviceAddressRecipient?: string|null,
     *     serviceEndDate?: mixed|null,
     *     serviceStartDate?: mixed|null,
     *     shippingAddress?: string|null,
     *     shippingAddressRecipient?: string|null,
     *     state?: string,
     *     subtotal?: float|string|null,
     *     taxDetails?: list<array{
     *
     * amount?: float|string|null, rate?: string|null
     *
     * }>|null,
     *     totalDiscount?: float|string|null,
     *     totalTax?: float|string|null,
     *     vendorAddress?: string|null,
     *     vendorAddressRecipient?: string|null,
     *     vendorEmail?: string|null,
     *     vendorName?: string|null,
     *     vendorTaxID?: string|null,
     *
     * } $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function create(
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse {
        [$parsed, $options] = CreateParams::parseRequest($params, $requestOptions);
        $resp = $this->client->request(
            method: 'post',
            path: 'api/documents/',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

    /**
     * @param array{documentID?: string} $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function retrieve(
        string $documentID,
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

    /**
     * @param array{documentID?: string} $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function delete(
        string $documentID,
        array $params,
        mixed $requestOptions = [],
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
     * @param array{
     *
     *     documentID?: string,
     *     email?: string|null,
     *     receiverPeppolID?: string|null,
     *     receiverPeppolScheme?: string|null,
     *     senderPeppolID?: string|null,
     *     senderPeppolScheme?: string|null,
     *
     * } $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function send(
        string $documentID,
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse {
        [$parsed, $options] = SendParams::parseRequest($params, $requestOptions);
        $resp = $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

    public function __construct(protected Client $client)
    {

        $this->attachments = new Attachments($client);
        $this->ubl = new Ubl($client);

    }
}
