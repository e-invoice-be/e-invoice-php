<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Delete an attachment from an invoice or credit note.
 *
 * @see EInvoiceAPI\Services\Documents\AttachmentsService::delete()
 *
 * @phpstan-type AttachmentDeleteParamsShape = array{documentID: string}
 */
final class AttachmentDeleteParams implements BaseModel
{
    /** @use SdkModel<AttachmentDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $documentID): self
    {
        $self = new self;

        $self['documentID'] = $documentID;

        return $self;
    }

    public function withDocumentID(string $documentID): self
    {
        $self = clone $this;
        $self['documentID'] = $documentID;

        return $self;
    }
}
