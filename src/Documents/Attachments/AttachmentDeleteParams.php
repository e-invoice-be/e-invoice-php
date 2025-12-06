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
 * @see EInvoiceAPI\Services\Documents\AttachmentsService::delete()
 *
 * @phpstan-type AttachmentDeleteParamsShape = array{document_id: string}
 */
final class AttachmentDeleteParams implements BaseModel
{
    /** @use SdkModel<AttachmentDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $document_id;

    /**
     * `new AttachmentDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentDeleteParams::with(document_id: ...)
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $document_id): self
    {
        $obj = new self;

        $obj['document_id'] = $document_id;

        return $obj;
    }

    public function withDocumentID(string $documentID): self
    {
        $obj = clone $this;
        $obj['document_id'] = $documentID;

        return $obj;
    }
}
