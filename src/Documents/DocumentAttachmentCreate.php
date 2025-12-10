<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type DocumentAttachmentCreateShape = array{
 *   fileName: string,
 *   fileData?: string|null,
 *   fileSize?: int|null,
 *   fileType?: string|null,
 * }
 */
final class DocumentAttachmentCreate implements BaseModel
{
    /** @use SdkModel<DocumentAttachmentCreateShape> */
    use SdkModel;

    #[Required('file_name')]
    public string $fileName;

    /**
     * Base64 encoded file data.
     */
    #[Optional('file_data', nullable: true)]
    public ?string $fileData;

    #[Optional('file_size')]
    public ?int $fileSize;

    #[Optional('file_type')]
    public ?string $fileType;

    /**
     * `new DocumentAttachmentCreate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentAttachmentCreate::with(fileName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentAttachmentCreate)->withFileName(...)
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
        string $fileName,
        ?string $fileData = null,
        ?int $fileSize = null,
        ?string $fileType = null,
    ): self {
        $self = new self;

        $self['fileName'] = $fileName;

        null !== $fileData && $self['fileData'] = $fileData;
        null !== $fileSize && $self['fileSize'] = $fileSize;
        null !== $fileType && $self['fileType'] = $fileType;

        return $self;
    }

    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    /**
     * Base64 encoded file data.
     */
    public function withFileData(?string $fileData): self
    {
        $self = clone $this;
        $self['fileData'] = $fileData;

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
}
