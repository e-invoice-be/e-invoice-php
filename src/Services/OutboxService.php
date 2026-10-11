<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Inbox\SortField;
use EInvoiceAPI\Inbox\SortOrder;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\OutboxContract;

final class OutboxService implements OutboxContract
{
    /**
     * @api
     */
    public OutboxRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OutboxRawService($client);
    }

    /**
     * @deprecated use `$client->drafts->list()` instead
     *
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options including state and text search.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField $sortBy Field to sort by
     * @param 'asc'|'desc'|SortOrder $sortOrder Sort direction (asc/desc)
     * @param 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null $state Filter by document state
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|'SELFBILLING_INVOICE'|'SELFBILLING_CREDIT_NOTE'|DocumentType|null $type Filter by document type
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        int $page = 1,
        int $pageSize = 20,
        ?string $search = null,
        string|SortField $sortBy = 'created_at',
        string|SortOrder $sortOrder = 'desc',
        string|DocumentState|null $state = null,
        string|DocumentType|null $type = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        $params = [
            'page' => $page,
            'pageSize' => $pageSize,
            'search' => $search,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'state' => $state,
            'type' => $type,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listDraftDocuments(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
     *
     * @param string|\DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param string|\DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $receiver Filter by receiver (customer_name, customer_email, customer_tax_id, customer_company_id, customer_id)
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender (Deprecated) Filter by sender ID
     * @param 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField $sortBy Field to sort by
     * @param 'asc'|'desc'|SortOrder $sortOrder Sort direction (asc/desc)
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|'SELFBILLING_INVOICE'|'SELFBILLING_CREDIT_NOTE'|DocumentType|null $type Filter by document type. If not provided, returns all types.
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        string|\DateTimeInterface|null $dateFrom = null,
        string|\DateTimeInterface|null $dateTo = null,
        int $page = 1,
        int $pageSize = 20,
        ?string $receiver = null,
        ?string $search = null,
        ?string $sender = null,
        string|SortField $sortBy = 'created_at',
        string|SortOrder $sortOrder = 'desc',
        string|DocumentType|null $type = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'pageSize' => $pageSize,
            'receiver' => $receiver,
            'search' => $search,
            'sender' => $sender,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'type' => $type,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listReceivedDocuments(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
