<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\Models\Documents\GetResponse;
use EInvoiceAPI\RequestOptions;

interface UblContract
{
    /**
     * @param array{documentID?: string} $params
     */
    public function get(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): GetResponse;
}
