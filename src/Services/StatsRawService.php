<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\StatsRawContract;
use EInvoiceAPI\Stats\StatGetResponse;
use EInvoiceAPI\Stats\StatRetrieveParams;

/**
 * @phpstan-import-type StatRetrieveParamsShape from StatRetrieveParams
 */
final class StatsRawService implements StatsRawContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve usage statistics for billing purposes. Returns statistics for document sent and document received actions, grouped by aggregation period (day/week/month). If no date parameters are provided, returns daily stats for all available data.
     *
     * @param StatRetrieveParamsShape|StatRetrieveParams $params
     *
     * @return BaseResponse<StatGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|StatRetrieveParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = StatRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/stats',
            query: Util::array_transform_keys(
                $parsed,
                ['endDate' => 'end_date', 'startDate' => 'start_date']
            ),
            options: $options,
            convert: StatGetResponse::class,
        );
    }
}
