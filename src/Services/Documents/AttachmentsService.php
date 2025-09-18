<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Implementation\HasRawResponse;
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
     * @param string $documentID
     *
     * @return DocumentAttachment<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment {
        $params = ['documentID' => $documentID];

        return $this->retrieveRaw($attachmentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DocumentAttachment<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $attachmentID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentRetrieveParams::parseRequest(
            $params,
            $requestOptions
        );
        $documentID = $parsed['documentID'];
        unset($parsed['documentID']);

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
        $params = [];

        return $this->listRaw($documentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return list<DocumentAttachment>
     *
     * @throws APIException
     */
    public function listRaw(
        string $documentID,
        mixed $params,
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
     * @param string $documentID
     *
     * @return AttachmentDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        $documentID,
        ?RequestOptions $requestOptions = null
    ): AttachmentDeleteResponse {
        $params = ['documentID' => $documentID];

        return $this->deleteRaw($attachmentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AttachmentDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $attachmentID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): AttachmentDeleteResponse {
        [$parsed, $options] = AttachmentDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $documentID = $parsed['documentID'];
        unset($parsed['documentID']);

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
     * @param string $file
     *
     * @return DocumentAttachment<HasRawResponse>
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        $file,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment {
        $params = ['file' => $file];

        return $this->addRaw($documentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DocumentAttachment<HasRawResponse>
     *
     * @throws APIException
     */
    public function addRaw(
        string $documentID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment {
        [$parsed, $options] = AttachmentAddParams::parseRequest(
            $params,
            $requestOptions
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
