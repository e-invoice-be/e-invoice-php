<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

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

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        string $id,
        string $fileName,
        ?int $fileSize = null,
        ?string $fileType = null,
        ?string $fileURL = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->id = $id;
        $this->fileName = $fileName;

        null !== $fileSize && $this->fileSize = $fileSize;
        null !== $fileType && $this->fileType = $fileType;
        null !== $fileURL && $this->fileURL = $fileURL;
    }
}
