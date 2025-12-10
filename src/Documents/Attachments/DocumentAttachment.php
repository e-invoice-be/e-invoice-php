<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type DocumentAttachmentShape = array{
 *   id: string,
 *   fileName: string,
 *   fileSize?: int|null,
 *   fileType?: string|null,
 *   fileURL?: string|null,
 * }
 */
final class DocumentAttachment implements BaseModel
{
    /** @use SdkModel<DocumentAttachmentShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('file_name')]
    public string $fileName;

    #[Optional('file_size')]
    public ?int $fileSize;

    #[Optional('file_type')]
    public ?string $fileType;

    #[Optional('file_url', nullable: true)]
    public ?string $fileURL;

    /**
     * `new DocumentAttachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentAttachment::with(id: ..., fileName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentAttachment)->withID(...)->withFileName(...)
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
        string $id,
        string $fileName,
        ?int $fileSize = null,
        ?string $fileType = null,
        ?string $fileURL = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['fileName'] = $fileName;

        null !== $fileSize && $self['fileSize'] = $fileSize;
        null !== $fileType && $self['fileType'] = $fileType;
        null !== $fileURL && $self['fileURL'] = $fileURL;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    public function withFileSize(int $fileSize): self
    {
        $self = clone $this;
        $self['fileSize'] = $fileSize;

        return $self;
    }

    public function withFileType(string $fileType): self
    {
        $self = clone $this;
        $self['fileType'] = $fileType;

        return $self;
    }

    public function withFileURL(?string $fileURL): self
    {
        $self = clone $this;
        $self['fileURL'] = $fileURL;

        return $self;
    }
}
