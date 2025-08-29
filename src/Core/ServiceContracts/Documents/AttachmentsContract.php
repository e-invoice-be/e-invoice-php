<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\ServiceContracts\Documents;

use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

interface AttachmentsContract
{
    /**
     * @api
     *
     * @param string $documentID
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
     */
    public function add(
        string $documentID,
        $file,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment;
}
