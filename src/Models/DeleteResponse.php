<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

class DeleteResponse implements BaseModel
{
    use Model;

    #[Api('is_deleted')]
    public bool $isDeleted;

    /** @param bool $isDeleted */
    final public function __construct($isDeleted)
    {
        $this->constructFromArgs(func_get_args());
    }
}

DeleteResponse::_loadMetadata();
