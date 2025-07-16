<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\UblContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\Documents\GetResponse;
use EInvoiceAPI\RequestOptions;

final class Ubl implements UblContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{documentID?: string} $params
     */
    public function get(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null
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
