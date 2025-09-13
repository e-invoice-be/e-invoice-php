<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Implementation\HasRawResponse;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\Documents\UblContract;

final class UblService implements UblContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the UBL for an invoice or credit note
     *
     * @return UblGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse {
        $params = [];

        return $this->getRaw($documentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return UblGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function getRaw(
        string $documentID,
        mixed $params,
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
