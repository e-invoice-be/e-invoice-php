<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Validate the correctness of a UBL document.
 *
 * @phpstan-type validate_ubl_params = array{file: string}
 */
final class ValidateValidateUblParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $file;

    /**
     * `new ValidateValidateUblParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ValidateValidateUblParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ValidateValidateUblParams)->withFile(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
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
