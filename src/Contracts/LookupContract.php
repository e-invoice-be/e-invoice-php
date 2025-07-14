<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\GetParticipantsResponse;
use EInvoiceAPI\Models\GetResponse;
use EInvoiceAPI\RequestOptions;

interface LookupContract
{
    /**
     * @param array{peppolID?: string} $params
     */
    public function retrieve(
        array $params,
        ?RequestOptions $requestOptions = null
    ): GetResponse;

    /**
     * @param array{query?: string, countryCode?: null|string} $params
     */
    public function retrieveParticipants(
        array $params,
        ?RequestOptions $requestOptions = null
    ): GetParticipantsResponse;
}
