<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\ServiceContracts;

use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use EInvoiceAPI\RequestOptions;

use const EInvoiceAPI\Core\OMIT as omit;

interface LookupContract
{
    /**
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    public function retrieve(
        $peppolID,
        ?RequestOptions $requestOptions = null
    ): LookupGetResponse;

    /**
     * @param string $query Query to lookup
     * @param string|null $countryCode Country code of the company to lookup. If not provided, the search will be global.
     */
    public function retrieveParticipants(
        $query,
        $countryCode = omit,
        ?RequestOptions $requestOptions = null
    ): LookupGetParticipantsResponse;
}
