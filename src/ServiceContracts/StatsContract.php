<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Stats\StatGetResponse;
use EInvoiceAPI\Stats\StatRetrieveParams\Aggregation;

interface StatsContract
{
    /**
     * @api
     *
     * @param 'DAY'|'WEEK'|'MONTH'|Aggregation|null $aggregation Aggregation type: DAY, WEEK, or MONTH. Defaults to DAY.
     * @param string|null $endDate End date in yyyy-mm-dd format. If not provided, queries to latest available data.
     * @param string|null $startDate Start date in yyyy-mm-dd format. If not provided, queries from earliest available data.
     *
     * `$startDate` and `$endDate` stay `?string` so an existing implementation keeps loading.
     * `StatsService::retrieve()` also accepts a `\DateTimeInterface`: a parameter type may be wider than the interface.
     *
     * @throws APIException
     */
    public function retrieve(
        string|Aggregation|null $aggregation = 'DAY',
        ?string $endDate = null,
        ?string $startDate = null,
        ?RequestOptions $requestOptions = null,
    ): StatGetResponse;
}
