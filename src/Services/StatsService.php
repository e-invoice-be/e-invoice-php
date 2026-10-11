<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\StatsContract;
use EInvoiceAPI\Stats\StatGetResponse;
use EInvoiceAPI\Stats\StatRetrieveParams\Aggregation;

final class StatsService implements StatsContract
{
    /**
     * @api
     */
    public StatsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new StatsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve usage statistics for billing purposes. Returns statistics for document sent and document received actions, grouped by aggregation period (day/week/month). If no date parameters are provided, returns daily stats for all available data.
     *
     * @param 'DAY'|'WEEK'|'MONTH'|Aggregation|null $aggregation Aggregation type: DAY, WEEK, or MONTH. Defaults to DAY.
     * @param string|null $endDate End date in yyyy-mm-dd format. If not provided, queries to latest available data.
     * @param string|null $startDate Start date in yyyy-mm-dd format. If not provided, queries from earliest available data.
     *
     * @throws APIException
     */
    public function retrieve(
        string|Aggregation|null $aggregation = 'DAY',
        ?string $endDate = null,
        ?string $startDate = null,
        ?RequestOptions $requestOptions = null,
    ): StatGetResponse {
        $params = [
            'aggregation' => $aggregation,
            'endDate' => $endDate,
            'startDate' => $startDate,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
