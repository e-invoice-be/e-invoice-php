<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour).
 *
 * @phpstan-type retrieve_params = array{documentID: string}
 */
final class AttachmentRetrieveParams implements BaseModel
{
    use Model;
    use Params;

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
        self::introspect();
        $this->unsetOptionalProperties();
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
