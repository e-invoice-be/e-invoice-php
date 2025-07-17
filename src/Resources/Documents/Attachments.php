<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\Documents\AttachmentsContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\Documents\DeleteResponse;
use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\Parameters\Documents\AttachmentAddParam;
use EInvoiceAPI\Parameters\Documents\AttachmentDeleteParam;
use EInvoiceAPI\Parameters\Documents\AttachmentRetrieveParam;
use EInvoiceAPI\RequestOptions;

final class Attachments implements AttachmentsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{documentID?: string}|AttachmentRetrieveParam $params
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
        return Serde::coerce(DocumentAttachment::class, value: $resp);
    }

    /**
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
        return Serde::coerce(new ListOf(DocumentAttachment::class), value: $resp);
    }

    /**
     * @param array{documentID?: string}|AttachmentDeleteParam $params
     */
    public function delete(
        string $attachmentID,
        array|AttachmentDeleteParam $params,
        ?RequestOptions $requestOptions = null,
    ): DeleteResponse {
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
        return Serde::coerce(DeleteResponse::class, value: $resp);
    }

    /**
     * @param array{file?: string}|AttachmentAddParam $params
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
        return Serde::coerce(DocumentAttachment::class, value: $resp);
    }
}
