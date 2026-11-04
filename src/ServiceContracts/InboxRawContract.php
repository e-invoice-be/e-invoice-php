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
 * @phpstan-import-type InboxListParamsShape from InboxListParams
 * @phpstan-import-type InboxListCreditNotesParamsShape from InboxListCreditNotesParams
 * @phpstan-import-type InboxListInvoicesParamsShape from InboxListInvoicesParams
 */
interface InboxRawContract
{
    /**
     * @api
     *
     * @param InboxListParamsShape|InboxListParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|InboxListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param InboxListCreditNotesParamsShape|InboxListCreditNotesParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        array|InboxListCreditNotesParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param InboxListInvoicesParamsShape|InboxListInvoicesParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listInvoices(
        array|InboxListInvoicesParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
