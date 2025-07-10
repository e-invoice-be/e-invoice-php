<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\LookupContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\GetResponse;
use EInvoiceAPI\Parameters\Lookup\RetrieveParams;
use EInvoiceAPI\RequestOptions;

class Lookup implements LookupContract
{
    public function __construct(protected Client $client) {}

    /**
     * @param array{peppolID?: string} $params
     */
    public function retrieve(
        array $params,
        ?RequestOptions $requestOptions = null
    ): GetResponse {
        [$parsed, $options] = RetrieveParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/lookup',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(GetResponse::class, value: $resp);
    }
}
