<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Webhooks;

use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class ListParams implements BaseModel
{
    use Model;
    use Params;

    final public function __construct()
    {
        $this->constructFromArgs(func_get_args());
    }
}

ListParams::_loadMetadata();
