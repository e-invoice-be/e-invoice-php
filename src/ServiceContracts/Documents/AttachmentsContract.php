<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Implementation\HasRawResponse;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

interface AttachmentsContract
{
    /**
     * @api
     *
     * @param string $documentID
     *
     * @return DocumentAttachment<HasRawResponse>
     */
    public function retrieve(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;

    /**
     * @api
     *
     * @return list<DocumentAttachment>
     */
    public function list(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param string $documentID
     *
     * @return AttachmentDeleteResponse<HasRawResponse>
     */
    public function delete(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse;

    /**
     * @api
     *
     * @param string $file
     *
     * @return DocumentAttachment<HasRawResponse>
     */
    public function add(
        string $documentID,
        $file,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment;
}
