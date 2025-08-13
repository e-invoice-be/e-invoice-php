<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type document_attachment_create_alias = array{
 *   fileName: string, fileData?: string|null, fileSize?: int, fileType?: string
 * }
 */
final class DocumentAttachmentCreate implements BaseModel
{
    use Model;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_data', optional: true)]
    public ?string $fileData;

    #[Api('file_size', optional: true)]
    public ?int $fileSize;

    #[Api('file_type', optional: true)]
    public ?string $fileType;

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

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function setFileData(?string $fileData): self
    {
        $this->fileData = $fileData;

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
}
