<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class AddParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $file;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string $file `required`
     */
    final public function __construct($file)
    {
        $this->constructFromArgs(func_get_args());
    }
}

AddParams::_loadMetadata();
