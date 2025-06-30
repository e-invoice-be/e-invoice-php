<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\LookupContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\GetResponse;
use EInvoiceAPI\Parameters\Lookup\RetrieveParams;

class Lookup implements LookupContract
{
    /**
     * @param array{peppolID?: string} $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function retrieve(
        array $params,
        mixed $requestOptions = [],
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

    public function __construct(protected Client $client)
    {
    }
}
