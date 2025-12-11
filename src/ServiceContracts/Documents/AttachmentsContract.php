<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

interface AttachmentsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        string $documentID,
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
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        string $documentID,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse;

    /**
     * @deprecated
     *
     * @api
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        string $file,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment;
}
