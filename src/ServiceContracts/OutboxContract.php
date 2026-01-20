<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams\SortBy;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams\SortOrder;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface OutboxContract
{
    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param SortBy|value-of<SortBy> $sortBy Field to sort by
     * @param SortOrder|value-of<SortOrder> $sortOrder Sort direction (asc/desc)
     * @param DocumentState|value-of<DocumentState>|null $state Filter by document state
     * @param DocumentType|value-of<DocumentType>|null $type Filter by document type
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        int $page = 1,
        int $pageSize = 20,
        ?string $search = null,
        SortBy|string $sortBy = 'created_at',
        SortOrder|string $sortOrder = 'desc',
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param \DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param \DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $receiver Filter by receiver (customer_name, customer_email, customer_tax_id, customer_company_id, customer_id)
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender (Deprecated) Filter by sender ID
     * @param \EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortBy|value-of<\EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortBy> $sortBy Field to sort by
     * @param \EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortOrder|value-of<\EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortOrder> $sortOrder Sort direction (asc/desc)
     * @param DocumentState|value-of<DocumentState>|null $state Filter by document state. If not provided, returns all states.
     * @param DocumentType|value-of<DocumentType>|null $type Filter by document type. If not provided, returns all types.
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        int $page = 1,
        int $pageSize = 20,
        ?string $receiver = null,
        ?string $search = null,
        ?string $sender = null,
        \EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortBy|string $sortBy = 'created_at',
        \EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortOrder|string $sortOrder = 'desc',
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;
}
