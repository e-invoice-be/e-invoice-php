<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

class DocumentAttachmentCreate implements BaseModel
{
    use Model;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_data', optional: true)]
    public ?string $fileData;

    #[Api('file_size', optional: true)]
    public int $fileSize;

    #[Api('file_type', optional: true)]
    public string $fileType;

    /**
     * @param string|null $fileData
     * @param int         $fileSize
     * @param string      $fileType
     */
    final public function __construct(
        string $fileName,
        string|None|null $fileData = None::NOT_SET,
        int|None $fileSize = None::NOT_SET,
        string|None $fileType = None::NOT_SET,
    ) {

        $args = func_get_args();

        $data = [];
        for ($i = 0; $i < count($args); ++$i) {
            if (None::NOT_SET !== $args[$i]) {
                $data[self::$_constructorArgNames[$i]] = $args[$i] ?? null;
            }
        }

        $this->__unserialize($data);

    }
}

DocumentAttachmentCreate::_loadMetadata();
