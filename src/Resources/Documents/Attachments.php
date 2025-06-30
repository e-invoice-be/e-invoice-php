<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources\Documents;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\AttachmentsContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\Models\Documents\DeleteResponse;
use EInvoiceAPI\Parameters\Documents\Attachments\RetrieveParams;
use EInvoiceAPI\Parameters\Documents\Attachments\DeleteParams;
use EInvoiceAPI\Parameters\Documents\Attachments\AddParams;

class Attachments implements AttachmentsContract
{
    /**
     * @param array{documentID?: string, attachmentID?: string} $params
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
        string $attachmentID,
        array $params,
        mixed $requestOptions = [],
    ): DocumentAttachment {
        [$parsed, $options] = RetrieveParams::parseRequest(
            $params,
            $requestOptions
        );
        $documentID = $parsed['documentID'];
        unset($parsed['documentID']);
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/attachments/%2$s', $documentID, $attachmentID],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentAttachment::class, value: $resp);
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
     *
     * @return list<DocumentAttachment>
     */
    public function list(
        string $documentID,
        array $params,
        mixed $requestOptions = [],
    ): array {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/attachments', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(new ListOf(DocumentAttachment::class), value: $resp);
    }

    /**
     * @param array{documentID?: string, attachmentID?: string} $params
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
        string $attachmentID,
        array $params,
        mixed $requestOptions = [],
    ): DeleteResponse {
        [$parsed, $options] = DeleteParams::parseRequest($params, $requestOptions);
        $documentID = $parsed['documentID'];
        unset($parsed['documentID']);
        $resp = $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s/attachments/%2$s', $documentID, $attachmentID],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DeleteResponse::class, value: $resp);
    }

    /**
     * @param array{documentID?: string, file?: string} $params
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
    public function add(
        string $documentID,
        array $params,
        mixed $requestOptions = [],
    ): DocumentAttachment {
        [$parsed, $options] = AddParams::parseRequest($params, $requestOptions);
        $resp = $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/attachments', $documentID],
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentAttachment::class, value: $resp);
    }

    public function __construct(protected Client $client)
    {
    }
}
