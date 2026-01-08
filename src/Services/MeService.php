<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Me\MeGetResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\MeContract;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class MeService implements MeContract
{
    /**
     * @api
     */
    public MeRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MeRawService($client);
    }

    /**
     * @api
     *
     * Retrieve information about your account.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): MeGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }
}
