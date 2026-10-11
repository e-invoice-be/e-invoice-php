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
use EInvoiceAPI\ServiceContracts\DraftsContract;

final class DraftsService implements DraftsContract
{
    /**
     * @api
     */
    public DraftsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DraftsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options including state and text search.
     *
     * @param string|\DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param string|\DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField $sortBy Field to sort by
     * @param 'asc'|'desc'|SortOrder $sortOrder Sort direction (asc/desc)
     * @param 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null $state Filter by document state. By default return all states (DRAFT, TRANSIT, FAILED).
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|'SELFBILLING_INVOICE'|'SELFBILLING_CREDIT_NOTE'|DocumentType|null $type Filter by document type
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
        string|SortField $sortBy = 'created_at',
        string|SortOrder $sortOrder = 'desc',
        string|DocumentState|null $state = null,
        string|DocumentType|null $type = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
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
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
