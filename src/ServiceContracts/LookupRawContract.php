<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use EInvoiceAPI\Lookup\LookupRetrieveParams;
use EInvoiceAPI\Lookup\LookupRetrieveParticipantsParams;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface LookupRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LookupRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LookupGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|LookupRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LookupRetrieveParticipantsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LookupGetParticipantsResponse>
     *
     * @throws APIException
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
