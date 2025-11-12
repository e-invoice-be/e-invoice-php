<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\Attachments\AttachmentAddParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\AttachmentRetrieveParams;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\Documents\AttachmentsContract;

final class AttachmentsService implements AttachmentsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour)
     *
     * @param array{document_id: string}|AttachmentRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        array|AttachmentRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $documentID = $parsed['document_id'];
        unset($parsed['document_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/attachments/%2$s', $documentID, $attachmentID],
            options: $options,
            convert: DocumentAttachment::class,
        );
    }

    /**
     * @api
     *
     * Get all attachments for an invoice or credit note
     *
     * @return list<DocumentAttachment>
     *
     * @throws APIException
     */
    public function list(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/attachments', $documentID],
            options: $requestOptions,
            convert: new ListOf(DocumentAttachment::class),
        );
    }

    /**
     * @api
     *
     * Delete an attachment from an invoice or credit note
     *
     * @param array{document_id: string}|AttachmentDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse {
        [$parsed, $options] = AttachmentDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $documentID = $parsed['document_id'];
        unset($parsed['document_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s/attachments/%2$s', $documentID, $attachmentID],
            options: $options,
            convert: AttachmentDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Add a new attachment to an invoice or credit note
     *
     * @param array{file: string}|AttachmentAddParams $params
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        array|AttachmentAddParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentAddParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/attachments', $documentID],
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: DocumentAttachment::class,
        );
    }
}
