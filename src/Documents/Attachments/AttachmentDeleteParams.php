<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Delete an attachment from an invoice or credit note.
 *
 * @see EInvoiceAPI\Documents\Attachments->delete
 *
 * @phpstan-type attachment_delete_params = array{documentID: string}
 */
final class AttachmentDeleteParams implements BaseModel
{
    /** @use SdkModel<attachment_delete_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $documentID;

    /**
     * `new AttachmentDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentDeleteParams::with(documentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachmentDeleteParams)->withDocumentID(...)
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
