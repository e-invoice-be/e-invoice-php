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
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface OutboxRawContract
{
    /**
     * @deprecated
     *
     * @api
     *
     * @param array<string,mixed>|OutboxListDraftDocumentsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|OutboxListReceivedDocumentsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
