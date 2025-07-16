<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class RetrieveParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $documentID;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string $documentID `required`
     */
    final public function __construct($documentID)
    {
        $this->constructFromArgs(func_get_args());
    }
}

RetrieveParams::_loadMetadata();
