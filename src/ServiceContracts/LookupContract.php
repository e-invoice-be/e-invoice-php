<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use EInvoiceAPI\RequestOptions;

use const EInvoiceAPI\Core\OMIT as omit;

interface LookupContract
{
    /**
     * @api
     *
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     *
     * @throws APIException
     */
    public function retrieve(
        $peppolID,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function retrieveRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse;

    /**
     * @api
     *
     * @param string $query Query to lookup
     * @param string|null $countryCode Country code of the company to lookup. If not provided, the search will be global.
     *
     * @throws APIException
     */
    public function retrieveParticipants(
        $query,
        $countryCode = omit,
        ?RequestOptions $requestOptions = null
    ): LookupGetParticipantsResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function retrieveParticipantsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): LookupGetParticipantsResponse;
}
