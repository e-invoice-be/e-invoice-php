<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\Models\Documents\DeleteResponse;
use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

interface AttachmentsContract
{
    /**
     * @param array{documentID?: string, attachmentID?: string} $params
     */
    public function retrieve(
        string $attachmentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;

    /**
     * @param array{documentID?: string} $params
     *
     * @return list<DocumentAttachment>
     */
    public function list(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): array;

    /**
     * @param array{documentID?: string, attachmentID?: string} $params
     */
    public function delete(
        string $attachmentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DeleteResponse;

    /**
     * @param array{documentID?: string, file?: string} $params
     */
    public function add(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;
}
