<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

class DocumentAttachment implements BaseModel
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
     * @param string      $id
     * @param string      $fileName
     * @param null|int    $fileSize
     * @param null|string $fileType
     * @param null|string $fileURL
     */
    final public function __construct(
        $id,
        $fileName,
        $fileSize = None::NOT_GIVEN,
        $fileType = None::NOT_GIVEN,
        $fileURL = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

DocumentAttachment::_loadMetadata();
