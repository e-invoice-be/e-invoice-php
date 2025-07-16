<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class DeleteResponse implements BaseModel
{
    use Model;

    #[Api('is_deleted')]
    public bool $isDeleted;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param bool $isDeleted `required`
     */
    final public function __construct($isDeleted)
    {
        $this->constructFromArgs(func_get_args());
    }
}

DeleteResponse::_loadMetadata();
