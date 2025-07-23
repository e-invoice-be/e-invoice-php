<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\AttachmentsContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\Parameters\Documents\AttachmentAddParam;
use EInvoiceAPI\Parameters\Documents\AttachmentDeleteParam;
use EInvoiceAPI\Parameters\Documents\AttachmentRetrieveParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Documents\AttachmentDeleteResponse;

final class Attachments implements AttachmentsContract
{
    public function __construct(private Client $client) {}

    /**
     * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour).
     *
     * @param array{documentID: string}|AttachmentRetrieveParam $params
     */
    public function retrieve(
        string $attachmentID,
        array|AttachmentRetrieveParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentRetrieveParam::parseRequest(
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
     * @param array{documentID: string}|AttachmentDeleteParam $params
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParam $params,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse {
        [$parsed, $options] = AttachmentDeleteParam::parseRequest(
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
     * @param array{file: string}|AttachmentAddParam $params
     */
    public function add(
        string $documentID,
        array|AttachmentAddParam $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentAddParam::parseRequest(
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
