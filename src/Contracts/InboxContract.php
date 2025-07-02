<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\RequestOptions;

interface InboxContract
{
    /**
     * @param array{
     *
     *       dateFrom?: \DateTimeInterface|null,
     *       dateTo?: \DateTimeInterface|null,
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
    public function list(
        array $params,
        mixed $requestOptions = []
    ): DocumentResponse;

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
    public function listCreditNotes(
        array $params,
        mixed $requestOptions = []
    ): DocumentResponse;

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
    public function listInvoices(
        array $params,
        mixed $requestOptions = []
    ): DocumentResponse;
}
