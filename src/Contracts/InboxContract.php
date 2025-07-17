<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Parameters\InboxListCreditNotesParam;
use EInvoiceAPI\Parameters\InboxListInvoicesParam;
use EInvoiceAPI\Parameters\InboxListParam;
use EInvoiceAPI\RequestOptions;

interface InboxContract
{
    /**
     * @param InboxListParam|array{
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
        array|InboxListParam $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int}|InboxListCreditNotesParam $params
     */
    public function listCreditNotes(
        array|InboxListCreditNotesParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int}|InboxListInvoicesParam $params
     */
    public function listInvoices(
        array|InboxListInvoicesParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
