<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class RetrieveParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $peppolID;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string $peppolID `required`
     */
    final public function __construct($peppolID)
    {
        $this->constructFromArgs(func_get_args());
    }
}

RetrieveParams::_loadMetadata();
