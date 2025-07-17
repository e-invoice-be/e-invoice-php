<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class DocumentAttachment implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_size', optional: true)]
    public ?int $fileSize = 0;

    #[Api('file_type', optional: true)]
    public ?string $fileType = 'application/pdf';

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
        $this->id = $id;
        $this->fileName = $fileName;

        self::_introspect();
        $this->unsetOptionalProperties();

        null != $fileSize && $this->fileSize = $fileSize;
        null != $fileType && $this->fileType = $fileType;
        null != $fileURL && $this->fileURL = $fileURL;
    }
}
