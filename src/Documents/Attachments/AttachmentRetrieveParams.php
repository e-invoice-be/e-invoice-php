<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour).
 *
 * @see EInvoiceAPI\Services\Documents\AttachmentsService::retrieve()
 *
 * @phpstan-type AttachmentRetrieveParamsShape = array{documentID: string}
 */
final class AttachmentRetrieveParams implements BaseModel
{
    /** @use SdkModel<AttachmentRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
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
