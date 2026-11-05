<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\InboxListCreditNotesParams;
use EInvoiceAPI\Inbox\InboxListInvoicesParams;
use EInvoiceAPI\Inbox\InboxListParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\InboxRawContract;

/**
 * @phpstan-import-type InboxListParamsShape from InboxListParams
 * @phpstan-import-type InboxListCreditNotesParamsShape from InboxListCreditNotesParams
 * @phpstan-import-type InboxListInvoicesParamsShape from InboxListInvoicesParams
 */
final class InboxRawService implements InboxRawContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a paginated list of received documents with filtering options including state, type, sender, date range, and text search.
     *
     * @param InboxListParamsShape|InboxListParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|InboxListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/inbox/',
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

    /**
     * @api
     *
     * Retrieve a paginated list of received credit notes with filtering options.
     *
     * @param InboxListCreditNotesParamsShape|InboxListCreditNotesParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        array|InboxListCreditNotesParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxListCreditNotesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/inbox/credit-notes',
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
     * Retrieve a paginated list of received invoices with filtering options.
     *
     * @param InboxListInvoicesParamsShape|InboxListInvoicesParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listInvoices(
        array|InboxListInvoicesParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxListInvoicesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/inbox/invoices',
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
}
