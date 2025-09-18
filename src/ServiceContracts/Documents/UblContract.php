<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Implementation\HasRawResponse;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;

interface UblContract
{
    /**
     * @api
     *
     * @return UblGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse;

    /**
     * @api
     *
     * @return UblGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function getRaw(
        string $documentID,
        mixed $params,
        ?RequestOptions $requestOptions = null,
    ): UblGetResponse;
}
