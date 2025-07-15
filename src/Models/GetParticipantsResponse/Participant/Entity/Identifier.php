<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetParticipantsResponse\Participant\Entity;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

class Identifier implements BaseModel
{
    use Model;

    #[Api]
    public string $scheme;

    #[Api]
    public string $value;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string $scheme `required`
     * @param string $value  `required`
     */
    final public function __construct($scheme, $value)
    {
        $this->constructFromArgs(func_get_args());
    }
}

Identifier::_loadMetadata();
