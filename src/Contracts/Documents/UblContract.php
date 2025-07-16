<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\Models\Documents\GetResponse;
use EInvoiceAPI\RequestOptions;

interface UblContract
{
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): GetResponse;
}
