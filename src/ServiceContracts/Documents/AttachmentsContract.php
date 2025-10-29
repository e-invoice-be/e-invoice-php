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
     * @param string $documentID
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $attachmentID,
        array $params,
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
     * @param string $documentID
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $attachmentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse;

    /**
     * @api
     *
     * @param string $file
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        $file,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function addRaw(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment;
}
