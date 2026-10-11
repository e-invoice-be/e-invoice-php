<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Inbox\SortField;
use EInvoiceAPI\Inbox\SortOrder;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\OutboxRawContract;

final class OutboxRawService implements OutboxRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @deprecated use `$client->drafts->list()` instead
     *
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options including state and text search.
     *
     * @param array{
     *   page?: int,
     *   pageSize?: int,
     *   search?: string|null,
     *   sortBy?: 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField,
     *   sortOrder?: 'asc'|'desc'|SortOrder,
     *   state?: 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null,
     *   type?: 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|'SELFBILLING_INVOICE'|'SELFBILLING_CREDIT_NOTE'|DocumentType|null,
     * }|OutboxListDraftDocumentsParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OutboxListDraftDocumentsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/outbox/drafts',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'pageSize' => 'page_size',
                    'sortBy' => 'sort_by',
                    'sortOrder' => 'sort_order',
                ],
            ),
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
     *
     * @param array{
     *   dateFrom?: string|\DateTimeInterface|null,
     *   dateTo?: string|\DateTimeInterface|null,
     *   page?: int,
     *   pageSize?: int,
     *   receiver?: string|null,
     *   search?: string|null,
     *   sender?: string|null,
     *   sortBy?: 'created_at'|'invoice_date'|'due_date'|'invoice_total'|'customer_name'|'vendor_name'|'invoice_id'|SortField,
     *   sortOrder?: 'asc'|'desc'|SortOrder,
     *   type?: 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|'SELFBILLING_INVOICE'|'SELFBILLING_CREDIT_NOTE'|DocumentType|null,
     * }|OutboxListReceivedDocumentsParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OutboxListReceivedDocumentsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/outbox/',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'dateFrom' => 'date_from',
                    'dateTo' => 'date_to',
                    'pageSize' => 'page_size',
                    'sortBy' => 'sort_by',
                    'sortOrder' => 'sort_order',
                ],
            ),
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );
    }
}
