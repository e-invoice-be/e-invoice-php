<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Drafts\DraftListParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\DraftsRawContract;

/**
 * @phpstan-import-type DraftListParamsShape from DraftListParams
 */
final class DraftsRawService implements DraftsRawContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options including state and text search.
     *
     * @param DraftListParamsShape|DraftListParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|DraftListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DraftListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/drafts/',
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
