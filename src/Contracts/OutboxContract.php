<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Parameters\OutboxListDraftDocumentsParam;
use EInvoiceAPI\Parameters\OutboxListReceivedDocumentsParam;
use EInvoiceAPI\RequestOptions;

interface OutboxContract
{
    /**
     * @param array{page?: int, pageSize?: int}|OutboxListDraftDocumentsParam $params
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @param OutboxListReceivedDocumentsParam|array{
     *   dateFrom?: \DateTimeInterface|null,
     *   dateTo?: \DateTimeInterface|null,
     *   page?: int,
     *   pageSize?: int,
     *   search?: string|null,
     *   sender?: string|null,
     *   state?: DocumentState::*,
     *   type?: DocumentType::*,
     * } $params
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
