<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Ubl;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Create a new invoice or credit note from a UBL file.
 *
 * @see EInvoiceAPI\Documents\Ubl->createFromUbl
 *
 * @phpstan-type ubl_create_from_ubl_params = array{file: string}
 */
final class UblCreateFromUblParams implements BaseModel
{
    /** @use SdkModel<ubl_create_from_ubl_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $file;

    /**
     * `new UblCreateFromUblParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UblCreateFromUblParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UblCreateFromUblParams)->withFile(...)
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
    public static function with(string $file): self
    {
        $obj = new self;

        $obj->file = $file;

        return $obj;
    }

    public function withFile(string $file): self
    {
        $obj = clone $this;
        $obj->file = $file;

        return $obj;
    }
}
