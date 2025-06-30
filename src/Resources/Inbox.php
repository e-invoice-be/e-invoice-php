<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\InboxContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Parameters\Inbox\ListParams;
use EInvoiceAPI\Parameters\Inbox\ListCreditNotesParams;
use EInvoiceAPI\Parameters\Inbox\ListInvoicesParams;

class Inbox implements InboxContract
{
    /**
     * @param array{
     *
     *     dateFrom?: mixed|null,
     *     dateTo?: mixed|null,
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
    public function list(
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse {
        [$parsed, $options] = ListParams::parseRequest($params, $requestOptions);
        $resp = $this->client->request(
            method: 'get',
            path: 'api/inbox/',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

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
    public function listCreditNotes(
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse {
        [$parsed, $options] = ListCreditNotesParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/inbox/credit-notes',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

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
    public function listInvoices(
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse {
        [$parsed, $options] = ListInvoicesParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/inbox/invoices',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DocumentResponse::class, value: $resp);
    }

    public function __construct(protected Client $client)
    {
    }
}
