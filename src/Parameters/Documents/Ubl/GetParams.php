<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\Ubl;

use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class GetParams implements BaseModel
{
    use Model;
    use Params;
}

GetParams::_loadMetadata();
