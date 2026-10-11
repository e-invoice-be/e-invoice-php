<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\SortField;
use EInvoiceAPI\Inbox\SortOrder;
use EInvoiceAPI\RequestOptions;

interface InboxContract
{
    /**
     * @api
     *
     * @param string|\DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param string|\DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender Filter by sender (vendor_name, vendor_email, vendor_tax_id, vendor_company_id)
     * @param 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField $sortBy Field to sort by
     * @param 'asc'|'desc'|SortOrder $sortOrder Sort direction (asc/desc)
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|'SELFBILLING_INVOICE'|'SELFBILLING_CREDIT_NOTE'|DocumentType|null $type Filter by document type. If not provided, returns all types.
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function list(
        string|\DateTimeInterface|null $dateFrom = null,
        string|\DateTimeInterface|null $dateTo = null,
        int $page = 1,
        int $pageSize = 20,
        ?string $search = null,
        ?string $sender = null,
        string|SortField $sortBy = 'created_at',
        string|SortOrder $sortOrder = 'desc',
        string|DocumentType|null $type = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField $sortBy Field to sort by
     * @param 'asc'|'desc'|SortOrder $sortOrder Sort direction (asc/desc)
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        int $page = 1,
        int $pageSize = 20,
        string|SortField $sortBy = 'created_at',
        string|SortOrder $sortOrder = 'desc',
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField $sortBy Field to sort by
     * @param 'asc'|'desc'|SortOrder $sortOrder Sort direction (asc/desc)
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listInvoices(
        int $page = 1,
        int $pageSize = 20,
        string|SortField $sortBy = 'created_at',
        string|SortOrder $sortOrder = 'desc',
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage;
}
