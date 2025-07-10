<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\RequestOptions;

interface InboxContract
{
    /**
     * @param array{
     *   dateFrom?: \DateTimeInterface|null,
     *   dateTo?: \DateTimeInterface|null,
     *   page?: int,
     *   pageSize?: int,
     *   search?: string|null,
     *   sender?: string|null,
     *   state?: string,
     *   type?: string,
     * } $params
     */
    public function list(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int} $params
     */
    public function listCreditNotes(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int} $params
     */
    public function listInvoices(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;
}
