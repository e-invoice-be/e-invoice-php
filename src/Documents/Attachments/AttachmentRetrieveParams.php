<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Get attachment details with for an invoice or credit note with link to download file (signed URL, valid for 1 hour).
 *
 * @see EInvoiceAPI\STAINLESS_FIXME_Documents\AttachmentsService::retrieve()
 *
 * @phpstan-type AttachmentRetrieveParamsShape = array{document_id: string}
 */
final class AttachmentRetrieveParams implements BaseModel
{
    /** @use SdkModel<AttachmentRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $document_id;

    /**
     * `new AttachmentRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentRetrieveParams::with(document_id: ...)
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
    public static function with(string $document_id): self
    {
        $obj = new self;

        $obj->document_id = $document_id;

        return $obj;
    }

    public function withDocumentID(string $documentID): self
    {
        $obj = clone $this;
        $obj->document_id = $documentID;

        return $obj;
    }
}
