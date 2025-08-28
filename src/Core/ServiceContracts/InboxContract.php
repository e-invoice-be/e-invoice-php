<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\ServiceContracts;

use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;

use const EInvoiceAPI\Core\OMIT as omit;

interface InboxContract
{
    /**
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
    ): DocumentsNumberPage;

    /**
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     */
    public function listCreditNotes(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage;

    /**
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     */
    public function listInvoices(
        $page = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage;
}
