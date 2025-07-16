<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Parameters\Outbox\ListDraftDocumentsParams;
use EInvoiceAPI\Parameters\Outbox\ListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;

interface OutboxContract
{
    /**
     * @param array{page?: int, pageSize?: int}|ListDraftDocumentsParams $params
     */
    public function listDraftDocuments(
        array|ListDraftDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @param ListReceivedDocumentsParams|array{
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
        array|ListReceivedDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
