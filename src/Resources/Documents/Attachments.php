<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\AttachmentsContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\Parameters\Documents\AttachmentAddParams;
use EInvoiceAPI\Parameters\Documents\AttachmentDeleteParams;
use EInvoiceAPI\Parameters\Documents\AttachmentRetrieveParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Documents\AttachmentDeleteResponse;

final class Attachments implements AttachmentsContract
{
    public function __construct(private Client $client) {}

    /**
     * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour).
     *
     * @param array{documentID: string}|AttachmentRetrieveParams $params
     */
    public function retrieve(
        string $attachmentID,
        array|AttachmentRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentRetrieveParams::parseRequest(
            $params,
            $requestOptions
        );
        $documentID = $parsed['documentID'];
        unset($parsed['documentID']);
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/attachments/%2$s', $documentID, $attachmentID],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DocumentAttachment::class, value: $resp);
    }

    /**
     * Get all attachments for an invoice or credit note.
     *
     * @return list<DocumentAttachment>
     */
    public function list(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): array {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/attachments', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(DocumentAttachment::class),
            value: $resp
        );
    }

    /**
     * Delete an attachment from an invoice or credit note.
     *
     * @param array{documentID: string}|AttachmentDeleteParams $params
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse {
        [$parsed, $options] = AttachmentDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $documentID = $parsed['documentID'];
        unset($parsed['documentID']);
        $resp = $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s/attachments/%2$s', $documentID, $attachmentID],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AttachmentDeleteResponse::class, value: $resp);
    }

    /**
     * Add a new attachment to an invoice or credit note.
     *
     * @param array{file: string}|AttachmentAddParams $params
     */
    public function add(
        string $documentID,
        array|AttachmentAddParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentAddParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/attachments', $documentID],
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DocumentAttachment::class, value: $resp);
    }
}
