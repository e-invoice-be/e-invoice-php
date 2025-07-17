<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Parameters\LookupRetrieveParam;
use EInvoiceAPI\Parameters\LookupRetrieveParticipantsParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse;
use EInvoiceAPI\Responses\LookupGetResponse;

interface LookupContract
{
    /**
     * @param array{peppolID?: string}|LookupRetrieveParam $params
     */
    public function retrieve(
        array|LookupRetrieveParam $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetResponse;

    /**
     * @param LookupRetrieveParticipantsParam|array{
     *   query?: string, countryCode?: string|null
     * } $params
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParam $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetParticipantsResponse;
}
