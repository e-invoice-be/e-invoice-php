<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\Parameters\Documents\AttachmentAddParam;
use EInvoiceAPI\Parameters\Documents\AttachmentDeleteParam;
use EInvoiceAPI\Parameters\Documents\AttachmentRetrieveParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Documents\AttachmentDeleteResponse;

interface AttachmentsContract
{
    /**
     * @param array{documentID: string}|AttachmentRetrieveParam $params
     */
    public function retrieve(
        string $attachmentID,
        array|AttachmentRetrieveParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;

    /**
     * @return list<DocumentAttachment>
     */
    public function list(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @param array{documentID: string}|AttachmentDeleteParam $params
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParam $params,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse;

    /**
     * @param array{file: string}|AttachmentAddParam $params
     */
    public function add(
        string $documentID,
        array|AttachmentAddParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;
}
