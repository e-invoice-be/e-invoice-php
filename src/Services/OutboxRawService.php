<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\OutboxRawContract;

/**
 * @phpstan-import-type OutboxListDraftDocumentsParamsShape from OutboxListDraftDocumentsParams
 * @phpstan-import-type OutboxListReceivedDocumentsParamsShape from OutboxListReceivedDocumentsParams
 */
final class OutboxRawService implements OutboxRawContract
{
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
     * @param OutboxListDraftDocumentsParamsShape|OutboxListDraftDocumentsParams $params
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
     * @param OutboxListReceivedDocumentsParamsShape|OutboxListReceivedDocumentsParams $params
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
