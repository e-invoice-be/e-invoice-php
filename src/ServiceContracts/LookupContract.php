<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use EInvoiceAPI\RequestOptions;

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
        string $peppolID,
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
        string $query,
        ?string $countryCode = null,
        ?RequestOptions $requestOptions = null,
    ): LookupGetParticipantsResponse;
}
