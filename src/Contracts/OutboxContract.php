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
     * @param array{
     *   dateFrom?: null|\DateTimeInterface,
     *   dateTo?: null|\DateTimeInterface,
     *   page?: int,
     *   pageSize?: int,
     *   search?: null|string,
     *   sender?: null|string,
     *   state?: DocumentState::*,
     *   type?: DocumentType::*,
     * }|OutboxListReceivedDocumentsParam $params
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
