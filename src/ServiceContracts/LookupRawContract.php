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

interface LookupRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|LookupRetrieveParams $params
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
     * @param array<mixed>|LookupRetrieveParticipantsParams $params
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
