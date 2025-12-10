<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
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
     * @param string|null $sender Filter by sender ID
     * @param 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null $state Filter by document state
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|DocumentType|null $type Filter by document type
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
        string|DocumentState|null $state = null,
        string|DocumentType|null $type = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        int $page = 1,
        int $pageSize = 20,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listInvoices(
        int $page = 1,
        int $pageSize = 20,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage;
}
