<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\Ubl\UblCreateFromUblParams;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;

interface UblContract
{
    /**
     * @api
     *
     * @param array<mixed>|UblCreateFromUblParams $params
     *
     * @throws APIException
     */
    public function createFromUbl(
        array|UblCreateFromUblParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse;
}
