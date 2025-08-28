<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\ServiceContracts\OutboxContract;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;

use const EInvoiceAPI\Core\OMIT as omit;

final class OutboxService implements OutboxContract
{
    public function __construct(private Client $client) {}

    /**
     * Retrieve a paginated list of draft documents with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     */
    public function listDraftDocuments(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        [$parsed, $options] = OutboxListDraftDocumentsParams::parseRequest(
            ['page' => $page, 'pageSize' => $pageSize],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'api/outbox/drafts',
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );
    }

    /**
     * Retrieve a paginated list of received documents with filtering options.
     *
     * @param \DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param \DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender Filter by sender ID
     * @param DocumentState::* $state Filter by document state
     * @param DocumentType::* $type Filter by document type
     *
     * @return DocumentsNumberPage<DocumentResponse>
     */
    public function listReceivedDocuments(
        $dateFrom = omit,
        $dateTo = omit,
        $page = omit,
        $pageSize = omit,
        $search = omit,
        $sender = omit,
        $state = omit,
        $type = omit,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        [$parsed, $options] = OutboxListReceivedDocumentsParams::parseRequest(
            [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page,
                'pageSize' => $pageSize,
                'search' => $search,
                'sender' => $sender,
                'state' => $state,
                'type' => $type,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'api/outbox/',
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );
    }
}
