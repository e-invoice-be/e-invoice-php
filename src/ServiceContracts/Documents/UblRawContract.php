<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\Ubl\UblCreateFromUblParams;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;

interface UblRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|UblCreateFromUblParams $params
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function createFromUbl(
        array|UblCreateFromUblParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<UblGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
