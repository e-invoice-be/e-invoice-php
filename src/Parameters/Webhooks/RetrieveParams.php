<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Webhooks;

use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class RetrieveParams implements BaseModel
{
    use Model;
    use Params;
}

RetrieveParams::_loadMetadata();
