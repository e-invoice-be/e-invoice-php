<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;

interface OutboxContract
{
    /**
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     */
    public function listDraftDocuments(
        $page = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @param \DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param \DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender Filter by sender ID
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
    ): DocumentResponse;
}
