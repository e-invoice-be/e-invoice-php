<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use EInvoiceAPI\Lookup\LookupRetrieveParams;
use EInvoiceAPI\Lookup\LookupRetrieveParticipantsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\LookupContract;

final class LookupService implements LookupContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Lookup Peppol ID. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
     *
     * @param array{peppol_id: string}|LookupRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        array|LookupRetrieveParams $params,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse {
        [$parsed, $options] = LookupRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'api/lookup',
            query: $parsed,
            options: $options,
            convert: LookupGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Lookup Peppol participants by name or other identifiers. You can limit the search to a specific country by providing the country code.
     *
     * @param array{
     *   query: string, country_code?: string|null
     * }|LookupRetrieveParticipantsParams $params
     *
     * @throws APIException
     */
    public function retrieveParticipants(
        array|LookupRetrieveParticipantsParams $params,
        ?RequestOptions $requestOptions = null,
    ): LookupGetParticipantsResponse {
        [$parsed, $options] = LookupRetrieveParticipantsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'api/lookup/participants',
            query: $parsed,
            options: $options,
            convert: LookupGetParticipantsResponse::class,
        );
    }
}
