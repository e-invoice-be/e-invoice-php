<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\GetParticipantsResponse;
use EInvoiceAPI\Models\GetResponse;
use EInvoiceAPI\Parameters\Lookup\RetrieveParams;
use EInvoiceAPI\Parameters\Lookup\RetrieveParticipantsParams;
use EInvoiceAPI\RequestOptions;

interface LookupContract
{
    /**
     * @param array{peppolID?: string}|RetrieveParams $params
     */
    public function retrieve(
        array|RetrieveParams $params,
        ?RequestOptions $requestOptions = null
    ): GetResponse;

    /**
     * @param RetrieveParticipantsParams|array{
     *   query?: string, countryCode?: string|null
     * } $params
     */
    public function retrieveParticipants(
        array|RetrieveParticipantsParams $params,
        ?RequestOptions $requestOptions = null,
    ): GetParticipantsResponse;
}
