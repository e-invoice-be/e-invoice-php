<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type DocumentAttachmentShape = array{
 *   id: string,
 *   file_name: string,
 *   file_size?: int|null,
 *   file_type?: string|null,
 *   file_url?: string|null,
 * }
 */
final class DocumentAttachment implements BaseModel
{
    /** @use SdkModel<DocumentAttachmentShape> */
    use SdkModel;

    #[Api]
    public string $id;

    #[Api]
    public string $file_name;

    #[Api(optional: true)]
    public ?int $file_size;

    #[Api(optional: true)]
    public ?string $file_type;

    #[Api(nullable: true, optional: true)]
    public ?string $file_url;

    /**
     * `new DocumentAttachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentAttachment::with(id: ..., file_name: ...)
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
        string $file_name,
        ?int $file_size = null,
        ?string $file_type = null,
        ?string $file_url = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['file_name'] = $file_name;

        null !== $file_size && $obj['file_size'] = $file_size;
        null !== $file_type && $obj['file_type'] = $file_type;
        null !== $file_url && $obj['file_url'] = $file_url;

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
        $obj['file_name'] = $fileName;

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

    public function withFileURL(?string $fileURL): self
    {
        $obj = clone $this;
        $obj['file_url'] = $fileURL;

        return $obj;
    }
}
