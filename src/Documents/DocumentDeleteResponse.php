<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type DocumentDeleteResponseShape = array{isDeleted: bool}
 */
final class DocumentDeleteResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<DocumentDeleteResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api('is_deleted')]
    public bool $isDeleted;

    /**
     * `new DocumentDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentDeleteResponse::with(isDeleted: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentDeleteResponse)->withIsDeleted(...)
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
    public static function with(bool $isDeleted): self
    {
        $obj = new self;

        $obj->isDeleted = $isDeleted;

        return $obj;
    }

    public function withIsDeleted(bool $isDeleted): self
    {
        $obj = clone $this;
        $obj->isDeleted = $isDeleted;

        return $obj;
    }
}
