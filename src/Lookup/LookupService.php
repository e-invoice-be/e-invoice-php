<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\LookupContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse;

final class LookupService implements LookupContract
{
    public function __construct(private Client $client) {}

    /**
     * Lookup Peppol ID. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
     *
     * @param array{peppolID: string}|LookupRetrieveParams $params
     */
    public function retrieve(
        array|LookupRetrieveParams $params,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse {
        [$parsed, $options] = LookupRetrieveParams::parseRequest(
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
        return Conversion::coerce(LookupGetResponse::class, value: $resp);
    }

    /**
     * Lookup Peppol participants by name or other identifiers. You can limit the search to a specific country by providing the country code.
     *
     * @param array{
     *   query: string, countryCode?: null|string
     * }|LookupRetrieveParticipantsParams $params
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParams $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetParticipantsResponse {
        [$parsed, $options] = LookupRetrieveParticipantsParams::parseRequest(
            $params,
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
