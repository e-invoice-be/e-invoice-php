<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts\Documents;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface AttachmentsContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        string $documentID,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentAttachment;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<DocumentAttachment>
     *
     * @throws APIException
     */
    public function list(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        string $documentID,
        RequestOptions|array|null $requestOptions = null,
    ): AttachmentDeleteResponse;

    /**
     * @deprecated
     *
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        string|FileParam $file,
        RequestOptions|array|null $requestOptions = null,
    ): DocumentAttachment;
}
