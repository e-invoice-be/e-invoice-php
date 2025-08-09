<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\LookupRetrieveParams;
use EInvoiceAPI\Models\LookupRetrieveParticipantsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse;
use EInvoiceAPI\Responses\LookupGetResponse;

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
