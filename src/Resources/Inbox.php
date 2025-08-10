<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\InboxContract;
use EInvoiceAPI\Core\Conversion;
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
     * Retrieve a paginated list of received documents with filtering options.
     *
     * @param array{
     *   dateFrom?: null|\DateTimeInterface,
     *   dateTo?: null|\DateTimeInterface,
     *   page?: int,
     *   pageSize?: int,
     *   search?: null|string,
     *   sender?: null|string,
     *   state?: DocumentState::*,
     *   type?: DocumentType::*,
     * }|InboxListParam $params
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
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }

    /**
     * Retrieve a paginated list of received credit notes with filtering options.
     *
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
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }

    /**
     * Retrieve a paginated list of received invoices with filtering options.
     *
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
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }
}
