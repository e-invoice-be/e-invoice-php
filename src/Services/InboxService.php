<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Inbox\InboxListCreditNotesParams;
use EInvoiceAPI\Inbox\InboxListInvoicesParams;
use EInvoiceAPI\Inbox\InboxListParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\InboxContract;

use const EInvoiceAPI\Core\OMIT as omit;

final class InboxService implements InboxContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a paginated list of received documents with filtering options including state, type, sender, date range, and text search.
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

        return $this->listRaw($params, $requestOptions);
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
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        [$parsed, $options] = InboxListParams::parseRequest(
            $params,
            $requestOptions
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
     * @api
     *
     * Retrieve a paginated list of received credit notes with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        $params = ['page' => $page, 'pageSize' => $pageSize];

        return $this->listCreditNotesRaw($params, $requestOptions);
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
    public function listCreditNotesRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        [$parsed, $options] = InboxListCreditNotesParams::parseRequest(
            $params,
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
     * @api
     *
     * Retrieve a paginated list of received invoices with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listInvoices(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        $params = ['page' => $page, 'pageSize' => $pageSize];

        return $this->listInvoicesRaw($params, $requestOptions);
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
    public function listInvoicesRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        [$parsed, $options] = InboxListInvoicesParams::parseRequest(
            $params,
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
