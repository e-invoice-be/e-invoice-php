<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Me\MeGetResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\MeContract;

final class MeService implements MeContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve information about your account.
     *
     * @throws APIException
     */
    public function retrieve(
        ?RequestOptions $requestOptions = null
    ): MeGetResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/me/',
            options: $requestOptions,
            convert: MeGetResponse::class,
        );
    }
}
