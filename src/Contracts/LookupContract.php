<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\GetParticipantsResponse;
use EInvoiceAPI\Models\GetResponse;
use EInvoiceAPI\Parameters\LookupRetrieveParam;
use EInvoiceAPI\Parameters\LookupRetrieveParticipantsParam;
use EInvoiceAPI\RequestOptions;

interface LookupContract
{
    /**
     * @param array{peppolID?: string}|LookupRetrieveParam $params
     */
    public function retrieve(
        array|LookupRetrieveParam $params,
        ?RequestOptions $requestOptions = null,
    ): GetResponse;

    /**
     * @param LookupRetrieveParticipantsParam|array{
     *   query?: string, countryCode?: string|null
     * } $params
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParam $params,
        ?RequestOptions $requestOptions = null,
    ): GetParticipantsResponse;
}
