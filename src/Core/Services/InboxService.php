<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Pagination\DocumentsNumberPage;
use EInvoiceAPI\Core\ServiceContracts\InboxContract;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Inbox\InboxListCreditNotesParams;
use EInvoiceAPI\Inbox\InboxListInvoicesParams;
use EInvoiceAPI\Inbox\InboxListParams;
use EInvoiceAPI\RequestOptions;

use const EInvoiceAPI\Core\OMIT as omit;

final class InboxService implements InboxContract
{
    public function __construct(private Client $client) {}

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
     */
    public function list(
        $dateFrom = omit,
        $dateTo = omit,
        $page = omit,
        $pageSize = omit,
        $search = omit,
        $sender = omit,
        $state = omit,
        $type = omit,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = InboxListParams::parseRequest(
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
            path: 'api/inbox/',
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );
    }

    /**
     * Retrieve a paginated list of received credit notes with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     */
    public function listCreditNotes(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = InboxListCreditNotesParams::parseRequest(
            ['page' => $page, 'pageSize' => $pageSize],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'api/inbox/credit-notes',
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );
    }

    /**
     * Retrieve a paginated list of received invoices with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     */
    public function listInvoices(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = InboxListInvoicesParams::parseRequest(
            ['page' => $page, 'pageSize' => $pageSize],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'api/inbox/invoices',
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );
    }
}
