<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\Models\Documents\DeleteResponse;
use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\Parameters\Documents\Attachments\AddParams;
use EInvoiceAPI\Parameters\Documents\Attachments\DeleteParams;
use EInvoiceAPI\Parameters\Documents\Attachments\RetrieveParams;
use EInvoiceAPI\RequestOptions;

interface AttachmentsContract
{
    /**
     * @param array{documentID?: string}|RetrieveParams $params
     */
    public function retrieve(
        string $attachmentID,
        array|RetrieveParams $params,
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
     * @param array{documentID?: string}|DeleteParams $params
     */
    public function delete(
        string $attachmentID,
        array|DeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): DeleteResponse;

    /**
     * @param AddParams|array{file?: string} $params
     */
    public function add(
        string $documentID,
        AddParams|array $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;
}
