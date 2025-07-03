<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\Models\Documents\GetResponse;
use EInvoiceAPI\RequestOptions;

interface UblContract
{
    /**
     * @param array{documentID?: string} $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function get(
        string $documentID,
        array $params,
        mixed $requestOptions = []
    ): GetResponse;
}
