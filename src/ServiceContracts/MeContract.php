<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Me\MeGetResponse;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface MeContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): MeGetResponse;
}
