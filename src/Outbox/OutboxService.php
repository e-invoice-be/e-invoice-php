<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\OutboxContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;

final class OutboxService implements OutboxContract
{
    public function __construct(private Client $client) {}

    /**
     * Retrieve a paginated list of draft documents with filtering options.
     *
     * @param array{page?: int, pageSize?: int}|OutboxListDraftDocumentsParams $params
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = OutboxListDraftDocumentsParams::parseRequest(
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
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }

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
     * }|OutboxListReceivedDocumentsParams $params
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = OutboxListReceivedDocumentsParams::parseRequest(
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
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }
}
