<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type DocumentAttachmentCreateShape = array{
 *   file_name: string,
 *   file_data?: string|null,
 *   file_size?: int|null,
 *   file_type?: string|null,
 * }
 */
final class DocumentAttachmentCreate implements BaseModel
{
    /** @use SdkModel<DocumentAttachmentCreateShape> */
    use SdkModel;

    #[Api]
    public string $file_name;

    /**
     * Base64 encoded file data.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $file_data;

    #[Api(optional: true)]
    public ?int $file_size;

    #[Api(optional: true)]
    public ?string $file_type;

    /**
     * `new DocumentAttachmentCreate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentAttachmentCreate::with(file_name: ...)
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
        string $file_name,
        ?string $file_data = null,
        ?int $file_size = null,
        ?string $file_type = null,
    ): self {
        $obj = new self;

        $obj['file_name'] = $file_name;

        null !== $file_data && $obj['file_data'] = $file_data;
        null !== $file_size && $obj['file_size'] = $file_size;
        null !== $file_type && $obj['file_type'] = $file_type;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj['file_name'] = $fileName;

        return $obj;
    }

    /**
     * Base64 encoded file data.
     */
    public function withFileData(?string $fileData): self
    {
        $obj = clone $this;
        $obj['file_data'] = $fileData;

        return $obj;
    }

    public function withFileSize(int $fileSize): self
    {
        $obj = clone $this;
        $obj['file_size'] = $fileSize;

        return $obj;
    }

    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj['file_type'] = $fileType;

        return $obj;
    }
}
