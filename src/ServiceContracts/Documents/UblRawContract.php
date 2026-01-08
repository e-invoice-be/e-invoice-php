<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\Ubl\UblCreateFromUblParams;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface UblRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|UblCreateFromUblParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function createFromUbl(
        array|UblCreateFromUblParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UblGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
