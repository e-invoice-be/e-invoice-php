<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\InboxListCreditNotesParams;
use EInvoiceAPI\Inbox\InboxListInvoicesParams;
use EInvoiceAPI\Inbox\InboxListParams;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface InboxRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboxListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|InboxListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboxListCreditNotesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        array|InboxListCreditNotesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboxListInvoicesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listInvoices(
        array|InboxListInvoicesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
