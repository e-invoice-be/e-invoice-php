<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\OutboxContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Parameters\OutboxListDraftDocumentsParam;
use EInvoiceAPI\Parameters\OutboxListReceivedDocumentsParam;
use EInvoiceAPI\RequestOptions;

final class Outbox implements OutboxContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{page?: int, pageSize?: int}|OutboxListDraftDocumentsParam $params
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = OutboxListDraftDocumentsParam::parseRequest(
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
     * @param OutboxListReceivedDocumentsParam|array{
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
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = OutboxListReceivedDocumentsParam::parseRequest(
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
