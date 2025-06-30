<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class ValidatePeppolIDParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $peppolID;
}

ValidatePeppolIDParams::_loadMetadata();
