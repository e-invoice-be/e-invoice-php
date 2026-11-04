<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type OutboxListDraftDocumentsParamsShape from OutboxListDraftDocumentsParams
 * @phpstan-import-type OutboxListReceivedDocumentsParamsShape from OutboxListReceivedDocumentsParams
 */
interface OutboxRawContract
{
    /**
     * @deprecated use `$client->drafts->list()` instead
     *
     * @api
     *
     * @param OutboxListDraftDocumentsParamsShape|OutboxListDraftDocumentsParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param OutboxListReceivedDocumentsParamsShape|OutboxListReceivedDocumentsParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
