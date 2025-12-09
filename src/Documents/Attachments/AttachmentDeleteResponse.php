<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type AttachmentDeleteResponseShape = array{is_deleted: bool}
 */
final class AttachmentDeleteResponse implements BaseModel
{
    /** @use SdkModel<AttachmentDeleteResponseShape> */
    use SdkModel;

    #[Api]
    public bool $is_deleted;

    /**
     * `new AttachmentDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentDeleteResponse::with(is_deleted: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachmentDeleteResponse)->withIsDeleted(...)
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
    public static function with(bool $is_deleted): self
    {
        $obj = new self;

        $obj['is_deleted'] = $is_deleted;

        return $obj;
    }

    public function withIsDeleted(bool $isDeleted): self
    {
        $obj = clone $this;
        $obj['is_deleted'] = $isDeleted;

        return $obj;
    }
}
