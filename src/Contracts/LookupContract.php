<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Lookup\LookupRetrieveParams;
use EInvoiceAPI\Lookup\LookupRetrieveParticipantsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse;

interface LookupContract
{
    /**
     * @param array{peppolID: string}|LookupRetrieveParams $params
     */
    public function retrieve(
        array|LookupRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetResponse;

    /**
     * @param array{
     *   query: string, countryCode?: null|string
     * }|LookupRetrieveParticipantsParams $params
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParams $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetParticipantsResponse;
}
