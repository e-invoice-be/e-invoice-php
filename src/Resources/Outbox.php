<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\OutboxContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Parameters\Outbox\ListDraftDocumentsParams;
use EInvoiceAPI\Parameters\Outbox\ListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;

class Outbox implements OutboxContract
{
    public function __construct(protected Client $client) {}

    /**
     * @param array{page?: int, pageSize?: int} $params
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
    public function listDraftDocuments(
        array $params,
        mixed $requestOptions = []
    ): DocumentResponse {
        [$parsed, $options] = ListDraftDocumentsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/outbox/drafts',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

    /**
     * @param array{
     *
     *     dateFrom?: \DateTimeInterface|null,
     *     dateTo?: \DateTimeInterface|null,
     *     page?: int,
     *     pageSize?: int,
     *     search?: string|null,
     *     sender?: string|null,
     *     state?: string,
     *     type?: string,
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
    public function listReceivedDocuments(
        array $params,
        mixed $requestOptions = []
    ): DocumentResponse {
        [$parsed, $options] = ListReceivedDocumentsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/outbox/',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }
}
