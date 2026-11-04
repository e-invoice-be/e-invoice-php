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
 * @phpstan-import-type LookupRetrieveParamsShape from LookupRetrieveParams
 * @phpstan-import-type LookupRetrieveParticipantsParamsShape from LookupRetrieveParticipantsParams
 */
interface LookupRawContract
{
    /**
     * @api
     *
     * @param LookupRetrieveParamsShape|LookupRetrieveParams $params
     *
     * @return BaseResponse<LookupGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|LookupRetrieveParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param LookupRetrieveParticipantsParamsShape|LookupRetrieveParticipantsParams $params
     *
     * @return BaseResponse<LookupGetParticipantsResponse>
     *
     * @throws APIException
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
