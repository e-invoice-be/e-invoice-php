<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Add a new attachment to an invoice or credit note.
 *
 * @phpstan-type add_params = array{file: string}
 */
final class AttachmentAddParam implements BaseModel
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
