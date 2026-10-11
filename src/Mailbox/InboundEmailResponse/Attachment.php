<?php

declare(strict_types=1);

namespace EInvoiceAPI\Mailbox\InboundEmailResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type AttachmentShape = array{
 *   filename: string, contentType?: string|null, size?: int|null
 * }
 */
final class Attachment implements BaseModel
{
    /** @use SdkModel<AttachmentShape> */
    use SdkModel;

    #[Required]
    public string $filename;

    #[Optional('content_type', nullable: true)]
    public ?string $contentType;

    #[Optional(nullable: true)]
    public ?int $size;

    /**
     * `new Attachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Attachment::with(filename: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Attachment)->withFilename(...)
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
    public static function with(
        string $filename,
        ?string $contentType = null,
        ?int $size = null
    ): self {
        $self = new self;

        $self['filename'] = $filename;

        null !== $contentType && $self['contentType'] = $contentType;
        null !== $size && $self['size'] = $size;

        return $self;
    }

    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    public function withContentType(?string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    public function withSize(?int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }
}
