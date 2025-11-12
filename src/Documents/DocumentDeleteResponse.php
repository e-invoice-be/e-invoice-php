<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type DocumentDeleteResponseShape = array{is_deleted: bool}
 */
final class DocumentDeleteResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<DocumentDeleteResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public bool $is_deleted;

    /**
     * `new DocumentDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentDeleteResponse::with(is_deleted: ...)
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
    public static function with(bool $is_deleted): self
    {
        $obj = new self;

        $obj->is_deleted = $is_deleted;

        return $obj;
    }

    public function withIsDeleted(bool $isDeleted): self
    {
        $obj = clone $this;
        $obj->is_deleted = $isDeleted;

        return $obj;
    }
}
