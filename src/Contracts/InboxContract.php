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
     * @param array{
     *   dateFrom?: null|\DateTimeInterface,
     *   dateTo?: null|\DateTimeInterface,
     *   page?: int,
     *   pageSize?: int,
     *   search?: null|string,
     *   sender?: null|string,
     *   state?: DocumentState::*,
     *   type?: DocumentType::*,
     * }|InboxListParam $params
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
