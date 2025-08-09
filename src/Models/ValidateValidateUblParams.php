<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Validate the correctness of a UBL document.
 *
 * @phpstan-type validate_ubl_params = array{file: string}
 */
final class ValidateValidateUblParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $file;

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
    public static function new(string $file): self
    {
        $obj = new self;

        $obj->file = $file;

        return $obj;
    }
}
