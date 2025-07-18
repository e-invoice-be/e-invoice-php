<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class DocumentAttachmentCreate implements BaseModel
{
    use Model;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_data', optional: true)]
    public ?string $fileData;

    #[Api('file_size', optional: true)]
    public ?int $fileSize = 0;

    #[Api('file_type', optional: true)]
    public ?string $fileType = 'application/pdf';

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        string $fileName,
        ?string $fileData = null,
        ?int $fileSize = null,
        ?string $fileType = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->fileName = $fileName;

        null !== $fileData && $this->fileData = $fileData;
        null !== $fileSize && $this->fileSize = $fileSize;
        null !== $fileType && $this->fileType = $fileType;
    }
}
