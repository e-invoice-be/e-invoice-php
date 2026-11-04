<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Stats\StatGetResponse;
use EInvoiceAPI\Stats\StatRetrieveParams;

/**
 * @phpstan-import-type StatRetrieveParamsShape from StatRetrieveParams
 */
interface StatsRawContract
{
    /**
     * @api
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
    ): BaseResponse;
}
