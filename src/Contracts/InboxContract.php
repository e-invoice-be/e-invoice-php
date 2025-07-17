<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Parameters\Inbox\ListCreditNotesParams;
use EInvoiceAPI\Parameters\Inbox\ListInvoicesParams;
use EInvoiceAPI\Parameters\Inbox\ListParams;
use EInvoiceAPI\RequestOptions;

interface InboxContract
{
    /**
     * @param ListParams|array{
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
    public function list(
        array|ListParams $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int}|ListCreditNotesParams $params
     */
    public function listCreditNotes(
        array|ListCreditNotesParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int}|ListInvoicesParams $params
     */
    public function listInvoices(
        array|ListInvoicesParams $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;
}
