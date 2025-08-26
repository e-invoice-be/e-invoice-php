<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\AttachmentsContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Documents\Attachments\AttachmentAddParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteParams;
use EInvoiceAPI\Documents\Attachments\AttachmentRetrieveParams;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Documents\Attachments\AttachmentDeleteResponse;

final class AttachmentsService implements AttachmentsContract
{
    public function __construct(private Client $client) {}

    /**
     * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour).
     *
     * @param string $documentID
     */
    public function retrieve(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentRetrieveParams::parseRequest(
            ['documentID' => $documentID],
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
     * @param string $documentID
     */
    public function delete(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null
    ): AttachmentDeleteResponse {
        [$parsed, $options] = AttachmentDeleteParams::parseRequest(
            ['documentID' => $documentID],
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
     * @param string $file
     */
    public function add(
        string $documentID,
        $file,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentAddParams::parseRequest(
            ['file' => $file],
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
