<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\OutboxContract;

use const EInvoiceAPI\Core\OMIT as omit;

final class OutboxService implements OutboxContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        $params = ['page' => $page, 'pageSize' => $pageSize];

        return $this->listDraftDocumentsRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listDraftDocumentsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        [$parsed, $options] = OutboxListDraftDocumentsParams::parseRequest(
            $params,
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
     * @api
     *
     * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
     *
     * @param \DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param \DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender Filter by sender ID
     * @param DocumentState|value-of<DocumentState>|null $state Filter by document state
     * @param DocumentType|value-of<DocumentType>|null $type Filter by document type
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
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
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'pageSize' => $pageSize,
            'search' => $search,
            'sender' => $sender,
            'state' => $state,
            'type' => $type,
        ];

        return $this->listReceivedDocumentsRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listReceivedDocumentsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        [$parsed, $options] = OutboxListReceivedDocumentsParams::parseRequest(
            $params,
            $requestOptions
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
