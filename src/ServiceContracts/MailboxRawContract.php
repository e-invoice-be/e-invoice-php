<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Mailbox\InboundEmailResponse;
use EInvoiceAPI\Mailbox\MailboxDownloadAttachmentParams;
use EInvoiceAPI\Mailbox\MailboxListParams;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type MailboxListParamsShape from MailboxListParams
 * @phpstan-import-type MailboxDownloadAttachmentParamsShape from MailboxDownloadAttachmentParams
 */
interface MailboxRawContract
{
    /**
     * @api
     *
     * @return BaseResponse<InboundEmailResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param MailboxListParamsShape|MailboxListParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<InboundEmailResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|MailboxListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param MailboxDownloadAttachmentParamsShape|MailboxDownloadAttachmentParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function downloadAttachment(
        string $filename,
        array|MailboxDownloadAttachmentParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<InboundEmailResponse>
     *
     * @throws APIException
     */
    public function reprocess(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
