<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents;

use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class DeleteParams implements BaseModel
{
    use Model;
    use Params;

    final public function __construct()
    {
        $this->constructFromArgs(func_get_args());
    }
}

DeleteParams::_loadMetadata();
