<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\RequestOptions;

interface OutboxContract
{
    /**
     * @param array{page?: int, pageSize?: int} $params
     */
    public function listDraftDocuments(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

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
    public function listReceivedDocuments(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;
}
