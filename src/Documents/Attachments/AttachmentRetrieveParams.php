<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new AttachmentRetrieveParams); // set properties as needed
 * $client->documents.attachments->retrieve(...$params->toArray());
 * ```
 * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour).
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->documents.attachments->retrieve(...$params->toArray());`
 *
 * @see EInvoiceAPI\Documents\Attachments->retrieve
 *
 * @phpstan-type attachment_retrieve_params = array{documentID: string}
 */
final class AttachmentRetrieveParams implements BaseModel
{
    /** @use SdkModel<attachment_retrieve_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $documentID;

    /**
     * `new AttachmentRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentRetrieveParams::with(documentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachmentRetrieveParams)->withDocumentID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $documentID): self
    {
        $obj = new self;

        $obj->documentID = $documentID;

        return $obj;
    }

    public function withDocumentID(string $documentID): self
    {
        $obj = clone $this;
        $obj->documentID = $documentID;

        return $obj;
    }
}
