<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\ServiceContracts\Documents\UblContract;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;

final class UblService implements UblContract
{
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the UBL for an invoice or credit note
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/ubl', $documentID],
            options: $requestOptions,
            convert: UblGetResponse::class,
        );
    }
}
