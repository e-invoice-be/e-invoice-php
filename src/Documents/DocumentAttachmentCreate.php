<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type DocumentAttachmentCreateShape = array{
 *   fileName: string, fileData?: string|null, fileSize?: int, fileType?: string
 * }
 */
final class DocumentAttachmentCreate implements BaseModel
{
    /** @use SdkModel<DocumentAttachmentCreateShape> */
    use SdkModel;

    #[Api('file_name')]
    public string $fileName;

    /**
     * Base64 encoded file data.
     */
    #[Api('file_data', nullable: true, optional: true)]
    public ?string $fileData;

    #[Api('file_size', optional: true)]
    public ?int $fileSize;

    #[Api('file_type', optional: true)]
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
        $obj = new self;

        $obj->fileName = $fileName;

        null !== $fileData && $obj->fileData = $fileData;
        null !== $fileSize && $obj->fileSize = $fileSize;
        null !== $fileType && $obj->fileType = $fileType;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj->fileName = $fileName;

        return $obj;
    }

    /**
     * Base64 encoded file data.
     */
    public function withFileData(?string $fileData): self
    {
        $obj = clone $this;
        $obj->fileData = $fileData;

        return $obj;
    }

    public function withFileSize(int $fileSize): self
    {
        $obj = clone $this;
        $obj->fileSize = $fileSize;

        return $obj;
    }

    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj->fileType = $fileType;

        return $obj;
    }
}
