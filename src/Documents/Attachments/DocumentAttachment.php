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
        $obj = new self;

        $obj['id'] = $id;
        $obj['fileName'] = $fileName;

        null !== $fileSize && $obj['fileSize'] = $fileSize;
        null !== $fileType && $obj['fileType'] = $fileType;
        null !== $fileURL && $obj['fileURL'] = $fileURL;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj['fileName'] = $fileName;

        return $obj;
    }

    public function withFileSize(int $fileSize): self
    {
        $obj = clone $this;
        $obj['fileSize'] = $fileSize;

        return $obj;
    }

    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj['fileType'] = $fileType;

        return $obj;
    }

    public function withFileURL(?string $fileURL): self
    {
        $obj = clone $this;
        $obj['fileURL'] = $fileURL;

        return $obj;
    }
}
