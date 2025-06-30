<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

class DocumentAttachment implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_size', optional: true)]
    public int $fileSize;

    #[Api('file_type', optional: true)]
    public string $fileType;

    #[Api('file_url', optional: true)]
    public ?string $fileURL;

    /**
     * @param int         $fileSize
     * @param string      $fileType
     * @param string|null $fileURL
     */
    final public function __construct(
        string $id,
        string $fileName,
        int|None $fileSize = None::NOT_SET,
        string|None $fileType = None::NOT_SET,
        string|None|null $fileURL = None::NOT_SET,
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

DocumentAttachment::_loadMetadata();
