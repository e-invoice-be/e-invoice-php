<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\LookupContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Parameters\LookupRetrieveParam;
use EInvoiceAPI\Parameters\LookupRetrieveParticipantsParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse;
use EInvoiceAPI\Responses\LookupGetResponse;

final class Lookup implements LookupContract
{
    public function __construct(private Client $client) {}

    /**
     * Lookup Peppol ID. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
     *
     * @param array{peppolID: string}|LookupRetrieveParam $params
     */
    public function retrieve(
        array|LookupRetrieveParam $params,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse {
        [$parsed, $options] = LookupRetrieveParam::parseRequest(
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
     * @param LookupRetrieveParticipantsParam|array{
     *   query: string, countryCode?: string|null
     * } $params
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParam $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetParticipantsResponse {
        [$parsed, $options] = LookupRetrieveParticipantsParam::parseRequest(
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
