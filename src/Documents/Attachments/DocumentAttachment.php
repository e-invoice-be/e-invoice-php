<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type document_attachment_alias = array{
 *   id: string,
 *   fileName: string,
 *   fileSize?: int,
 *   fileType?: string,
 *   fileURL?: string|null,
 * }
 */
final class DocumentAttachment implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_size', optional: true)]
    public ?int $fileSize;

    #[Api('file_type', optional: true)]
    public ?string $fileType;

    #[Api('file_url', optional: true)]
    public ?string $fileURL;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
        string $id,
        string $fileName,
        ?int $fileSize = null,
        ?string $fileType = null,
        ?string $fileURL = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->fileName = $fileName;

        null !== $fileSize && $obj->fileSize = $fileSize;
        null !== $fileType && $obj->fileType = $fileType;
        null !== $fileURL && $obj->fileURL = $fileURL;

        return $obj;
    }

    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function setFileType(string $fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    public function setFileURL(?string $fileURL): self
    {
        $this->fileURL = $fileURL;

        return $this;
    }
}
