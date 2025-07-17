<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\InboxContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Parameters\Inbox\ListCreditNotesParams;
use EInvoiceAPI\Parameters\Inbox\ListInvoicesParams;
use EInvoiceAPI\Parameters\Inbox\ListParams;
use EInvoiceAPI\RequestOptions;

final class Inbox implements InboxContract
{
    public function __construct(private Client $client) {}

    /**
     * @param ListParams|array{
     *   dateFrom?: \DateTimeInterface|null,
     *   dateTo?: \DateTimeInterface|null,
     *   page?: int,
     *   pageSize?: int,
     *   search?: string|null,
     *   sender?: string|null,
     *   state?: DocumentState::*,
     *   type?: DocumentType::*,
     * } $params
     */
    public function list(
        array|ListParams $params,
        ?RequestOptions $requestOptions = null
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
     * @param array{page?: int, pageSize?: int}|ListCreditNotesParams $params
     */
    public function listCreditNotes(
        array|ListCreditNotesParams $params,
        ?RequestOptions $requestOptions = null
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
     * @param array{page?: int, pageSize?: int}|ListInvoicesParams $params
     */
    public function listInvoices(
        array|ListInvoicesParams $params,
        ?RequestOptions $requestOptions = null
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
}
