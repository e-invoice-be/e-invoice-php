<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentResponse;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Models\InboxListCreditNotesParams;
use EInvoiceAPI\Models\InboxListInvoicesParams;
use EInvoiceAPI\Models\InboxListParams;
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
     * }|InboxListParams $params
     */
    public function list(
        array|InboxListParams $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int}|InboxListCreditNotesParams $params
     */
    public function listCreditNotes(
        array|InboxListCreditNotesParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @param array{page?: int, pageSize?: int}|InboxListInvoicesParams $params
     */
    public function listInvoices(
        array|InboxListInvoicesParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;
}
