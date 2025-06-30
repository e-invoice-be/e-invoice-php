<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Models\DocumentResponse;

interface OutboxContract
{
    /**
     * @param array{page?: int, pageSize?: int} $params
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
    public function listDraftDocuments(
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse;

    /**
     * @param array{
     *
     *       dateFrom?: mixed|null,
     *       dateTo?: mixed|null,
     *       page?: int,
     *       pageSize?: int,
     *       search?: string|null,
     *       sender?: string|null,
     *       state?: string,
     *       type?: string,
     *
     * } $params
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
    public function listReceivedDocuments(
        array $params,
        mixed $requestOptions = [],
    ): DocumentResponse;
}
