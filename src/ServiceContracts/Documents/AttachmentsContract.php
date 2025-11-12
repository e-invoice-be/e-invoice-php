<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\Attachments\AttachmentAddParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\AttachmentRetrieveParams;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

interface AttachmentsContract
{
    /**
     * @api
     *
     * @param array<mixed>|AttachmentRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        array|AttachmentRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;

    /**
     * @api
     *
     * @return list<DocumentAttachment>
     *
     * @throws APIException
     */
    public function list(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param array<mixed>|AttachmentDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse;

    /**
     * @api
     *
     * @param array<mixed>|AttachmentAddParams $params
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        array|AttachmentAddParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;
}
