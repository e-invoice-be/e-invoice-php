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
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface AttachmentsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AttachmentRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentAttachment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        array|AttachmentRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<DocumentAttachment>>
     *
     * @throws APIException
     */
    public function list(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AttachmentDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AttachmentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @deprecated
     *
     * @api
     *
     * @param array<string,mixed>|AttachmentAddParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentAttachment>
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        array|AttachmentAddParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
