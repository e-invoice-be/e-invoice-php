<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\LookupContract;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class LookupService implements LookupContract
{
    /**
     * @api
     */
    public LookupRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LookupRawService($client);
    }

    /**
     * @api
     *
     * Lookup Peppol ID. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
     *
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $peppolID,
        RequestOptions|array|null $requestOptions = null
    ): LookupGetResponse {
        $params = Util::removeNulls(['peppolID' => $peppolID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lookup Peppol participants by name or other identifiers. You can limit the search to a specific country by providing the country code.
     *
     * @param string $query Query to lookup
     * @param string|null $countryCode Country code of the company to lookup. If not provided, the search will be global.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveParticipants(
        string $query,
        ?string $countryCode = null,
        RequestOptions|array|null $requestOptions = null,
    ): LookupGetParticipantsResponse {
        $params = Util::removeNulls(
            ['query' => $query, 'countryCode' => $countryCode]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveParticipants(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
