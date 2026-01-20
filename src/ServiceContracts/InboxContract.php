<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Inbox\InboxListParams\SortBy;
use EInvoiceAPI\Inbox\InboxListParams\SortOrder;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface InboxContract
{
    /**
     * @api
     *
     * @param \DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param \DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender Filter by sender (vendor_name, vendor_email, vendor_tax_id, vendor_company_id)
     * @param SortBy|value-of<SortBy> $sortBy Field to sort by
     * @param SortOrder|value-of<SortOrder> $sortOrder Sort direction (asc/desc)
     * @param DocumentState|value-of<DocumentState>|null $state Filter by document state. If not provided, returns all states.
     * @param DocumentType|value-of<DocumentType>|null $type Filter by document type. If not provided, returns all types.
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function list(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        int $page = 1,
        int $pageSize = 20,
        ?string $search = null,
        ?string $sender = null,
        SortBy|string $sortBy = 'created_at',
        SortOrder|string $sortOrder = 'desc',
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param \EInvoiceAPI\Inbox\InboxListCreditNotesParams\SortBy|value-of<\EInvoiceAPI\Inbox\InboxListCreditNotesParams\SortBy> $sortBy Field to sort by
     * @param \EInvoiceAPI\Inbox\InboxListCreditNotesParams\SortOrder|value-of<\EInvoiceAPI\Inbox\InboxListCreditNotesParams\SortOrder> $sortOrder Sort direction (asc/desc)
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        int $page = 1,
        int $pageSize = 20,
        \EInvoiceAPI\Inbox\InboxListCreditNotesParams\SortBy|string $sortBy = 'created_at',
        \EInvoiceAPI\Inbox\InboxListCreditNotesParams\SortOrder|string $sortOrder = 'desc',
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param \EInvoiceAPI\Inbox\InboxListInvoicesParams\SortBy|value-of<\EInvoiceAPI\Inbox\InboxListInvoicesParams\SortBy> $sortBy Field to sort by
     * @param \EInvoiceAPI\Inbox\InboxListInvoicesParams\SortOrder|value-of<\EInvoiceAPI\Inbox\InboxListInvoicesParams\SortOrder> $sortOrder Sort direction (asc/desc)
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listInvoices(
        int $page = 1,
        int $pageSize = 20,
        \EInvoiceAPI\Inbox\InboxListInvoicesParams\SortBy|string $sortBy = 'created_at',
        \EInvoiceAPI\Inbox\InboxListInvoicesParams\SortOrder|string $sortOrder = 'desc',
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;
}
