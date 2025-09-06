<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;

interface UblContract
{
    /**
     * @api
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse;
}
