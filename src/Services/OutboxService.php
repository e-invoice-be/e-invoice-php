<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\OutboxContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;

final class OutboxService implements OutboxContract
{
    public function __construct(private Client $client) {}

    /**
     * Retrieve a paginated list of draft documents with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     */
    public function listDraftDocuments(
        $page = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        $args = ['page' => $page, 'pageSize' => $pageSize];
        $args = Util::array_filter_null($args, ['page', 'pageSize']);
        [$parsed, $options] = OutboxListDraftDocumentsParams::parseRequest(
            $args,
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
     * @param null|\DateTimeInterface $dateFrom Filter by issue date (from)
     * @param null|\DateTimeInterface $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param null|string $search Search in invoice number, seller/buyer names
     * @param null|string $sender Filter by sender ID
     * @param DocumentState::* $state Filter by document state
     * @param DocumentType::* $type Filter by document type
     */
    public function listReceivedDocuments(
        $dateFrom = null,
        $dateTo = null,
        $page = null,
        $pageSize = null,
        $search = null,
        $sender = null,
        $state = null,
        $type = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        $args = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'pageSize' => $pageSize,
            'search' => $search,
            'sender' => $sender,
            'state' => $state,
            'type' => $type,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'dateFrom',
                'dateTo',
                'page',
                'pageSize',
                'search',
                'sender',
                'state',
                'type',
            ],
        );
        [$parsed, $options] = OutboxListReceivedDocumentsParams::parseRequest(
            $args,
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
