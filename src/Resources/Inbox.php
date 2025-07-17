<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\InboxContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Parameters\InboxListCreditNotesParam;
use EInvoiceAPI\Parameters\InboxListInvoicesParam;
use EInvoiceAPI\Parameters\InboxListParam;
use EInvoiceAPI\RequestOptions;

final class Inbox implements InboxContract
{
    public function __construct(private Client $client) {}

    /**
     * @param InboxListParam|array{
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
        array|InboxListParam $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = InboxListParam::parseRequest(
            $params,
            $requestOptions
        );
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
     * @param array{page?: int, pageSize?: int}|InboxListCreditNotesParam $params
     */
    public function listCreditNotes(
        array|InboxListCreditNotesParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = InboxListCreditNotesParam::parseRequest(
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
     * @param array{page?: int, pageSize?: int}|InboxListInvoicesParam $params
     */
    public function listInvoices(
        array|InboxListInvoicesParam $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = InboxListInvoicesParam::parseRequest(
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
