<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\UblContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Documents\UblGetResponse;

final class Ubl implements UblContract
{
    public function __construct(private Client $client) {}

    /**
     * Get the UBL for an invoice or credit note.
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/ubl', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(UblGetResponse::class, value: $resp);
    }
}
