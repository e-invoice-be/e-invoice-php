<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\Attachments\AttachmentAddParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\AttachmentRetrieveParams;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type AttachmentRetrieveParamsShape from AttachmentRetrieveParams
 * @phpstan-import-type AttachmentDeleteParamsShape from AttachmentDeleteParams
 * @phpstan-import-type AttachmentAddParamsShape from AttachmentAddParams
 */
interface AttachmentsRawContract
{
    /**
     * @api
     *
     * @param AttachmentRetrieveParamsShape|AttachmentRetrieveParams $params
     *
     * @return BaseResponse<DocumentAttachment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        array|AttachmentRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<list<DocumentAttachment>>
     *
     * @throws APIException
     */
    public function list(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param AttachmentDeleteParamsShape|AttachmentDeleteParams $params
     *
     * @return BaseResponse<AttachmentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @deprecated
     *
     * @api
     *
     * @param AttachmentAddParamsShape|AttachmentAddParams $params
     *
     * @return BaseResponse<DocumentAttachment>
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        array|AttachmentAddParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
