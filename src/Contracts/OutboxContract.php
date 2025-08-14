<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;

interface OutboxContract
{
    /**
     * @param array{page?: int, pageSize?: int}|OutboxListDraftDocumentsParams $params
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParams $params,
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
     * }|OutboxListReceivedDocumentsParams $params
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
