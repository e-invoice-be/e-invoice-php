<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
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
     * @param string|null $sender Filter by sender ID
     * @param DocumentState|value-of<DocumentState>|null $state Filter by document state
     * @param DocumentType|value-of<DocumentType>|null $type Filter by document type
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
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        int $page = 1,
        int $pageSize = 20,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listInvoices(
        int $page = 1,
        int $pageSize = 20,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentsNumberPage;
}
