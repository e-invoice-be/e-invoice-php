<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Documents\UblGetResponse;

interface UblContract
{
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse;
}
