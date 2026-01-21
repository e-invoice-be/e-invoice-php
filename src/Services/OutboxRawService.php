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
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams\SortBy;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams\SortOrder;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\OutboxRawContract;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class OutboxRawService implements OutboxRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @deprecated
     *
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options including state and text search.
     *
     * @param array{
     *   page?: int,
     *   pageSize?: int,
     *   search?: string|null,
     *   sortBy?: value-of<SortBy>,
     *   sortOrder?: SortOrder|value-of<SortOrder>,
     *   state?: DocumentState|value-of<DocumentState>|null,
     *   type?: value-of<DocumentType>,
     * }|OutboxListDraftDocumentsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParams $params,
        RequestOptions|array|null $requestOptions = null,
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
     *   dateFrom?: \DateTimeInterface|null,
     *   dateTo?: \DateTimeInterface|null,
     *   page?: int,
     *   pageSize?: int,
     *   receiver?: string|null,
     *   search?: string|null,
     *   sender?: string|null,
     *   sortBy?: value-of<OutboxListReceivedDocumentsParams\SortBy>,
     *   sortOrder?: OutboxListReceivedDocumentsParams\SortOrder|value-of<OutboxListReceivedDocumentsParams\SortOrder>,
     *   type?: value-of<DocumentType>,
     * }|OutboxListReceivedDocumentsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParams $params,
        RequestOptions|array|null $requestOptions = null,
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
