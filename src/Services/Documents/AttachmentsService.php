<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\Documents\AttachmentsContract;

final class AttachmentsService implements AttachmentsContract
{
    /**
     * @api
     */
    public AttachmentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AttachmentsRawService($client);
    }

    /**
     * @api
     *
     * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour)
     *
     * @throws APIException
     */
    public function retrieve(
        string $attachmentID,
        string $documentID,
        ?RequestOptions $requestOptions = null,
    ): DocumentAttachment {
        $params = ['documentID' => $documentID];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($attachmentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an attachment from an invoice or credit note
     *
     * @throws APIException
     */
    public function delete(
        string $attachmentID,
        string $documentID,
        ?RequestOptions $requestOptions = null,
    ): AttachmentDeleteResponse {
        $params = ['documentID' => $documentID];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($attachmentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @deprecated
     *
     * @api
     *
     * Add one or more attachments to an invoice. Be careful: the attachments ARE NOT ADDED to the UBL! They are only stored in our database and can be downloaded later. To add attachments to the UBL, you need to add the attachment(s) via POST /api/documents
     *
     * @throws APIException
     */
    public function add(
        string $documentID,
        string|FileParam $file,
        ?RequestOptions $requestOptions = null
    ): DocumentAttachment {
        $params = ['file' => $file];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->add($documentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
