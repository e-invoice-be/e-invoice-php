<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\UblContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\Documents\GetResponse;
use EInvoiceAPI\RequestOptions;

class Ubl implements UblContract
{
    public function __construct(protected Client $client) {}

    /**
     * @param array{documentID?: string} $params
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
    public function get(
        string $documentID,
        array $params,
        mixed $requestOptions = []
    ): GetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/ubl', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(GetResponse::class, value: $resp);
    }
}
