<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string      $fileName `required`
     * @param null|string $fileData
     * @param null|int    $fileSize
     * @param null|string $fileType
     */
    final public function __construct(
        $fileName,
        $fileData = None::NOT_GIVEN,
        $fileSize = None::NOT_GIVEN,
        $fileType = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

DocumentAttachmentCreate::_loadMetadata();
