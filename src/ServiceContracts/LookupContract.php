<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use EInvoiceAPI\Lookup\LookupRetrieveParams;
use EInvoiceAPI\Lookup\LookupRetrieveParticipantsParams;
use EInvoiceAPI\RequestOptions;

interface LookupContract
{
    /**
     * @api
     *
     * @param array<mixed>|LookupRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        array|LookupRetrieveParams $params,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse;

    /**
     * @api
     *
     * @param array<mixed>|LookupRetrieveParticipantsParams $params
     *
     * @throws APIException
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParams $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetParticipantsResponse;
}
