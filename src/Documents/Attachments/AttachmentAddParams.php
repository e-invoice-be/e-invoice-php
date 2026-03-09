<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Add one or more attachments when creating a new invoice or credit note via POST /api/documents/.
 *
 * @deprecated
 * @see EInvoiceAPI\Services\Documents\AttachmentsService::add()
 *
 * @phpstan-type AttachmentAddParamsShape = array{file: string}
 */
final class AttachmentAddParams implements BaseModel
{
    /** @use SdkModel<AttachmentAddParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $file;

    /**
     * `new AttachmentAddParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentAddParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachmentAddParams)->withFile(...)
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
    public static function with(string $file): self
    {
        $self = new self;

        $self['file'] = $file;

        return $self;
    }

    public function withFile(string $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }
}
