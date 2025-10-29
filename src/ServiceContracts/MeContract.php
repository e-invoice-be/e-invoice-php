<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Me\MeGetResponse;
use EInvoiceAPI\RequestOptions;

interface MeContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        ?RequestOptions $requestOptions = null
    ): MeGetResponse;
}
