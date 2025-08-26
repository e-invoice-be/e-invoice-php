<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\LookupContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Lookup\LookupRetrieveParams;
use EInvoiceAPI\Lookup\LookupRetrieveParticipantsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse;

use const EInvoiceAPI\Core\OMIT as omit;

final class LookupService implements LookupContract
{
    public function __construct(private Client $client) {}

    /**
     * Lookup Peppol ID. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
     *
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    public function retrieve(
        $peppolID,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse {
        $args = ['peppolID' => $peppolID];
        [$parsed, $options] = LookupRetrieveParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/lookup',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LookupGetResponse::class, value: $resp);
    }

    /**
     * Lookup Peppol participants by name or other identifiers. You can limit the search to a specific country by providing the country code.
     *
     * @param string $query Query to lookup
     * @param string|null $countryCode Country code of the company to lookup. If not provided, the search will be global.
     */
    public function retrieveParticipants(
        $query,
        $countryCode = omit,
        ?RequestOptions $requestOptions = null
    ): LookupGetParticipantsResponse {
        $args = Util::array_filter_omit(
            ['query' => $query, 'countryCode' => $countryCode]
        );
        [$parsed, $options] = LookupRetrieveParticipantsParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/lookup/participants',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            LookupGetParticipantsResponse::class,
            value: $resp
        );
    }
}
