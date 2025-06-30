<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class AddParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $file;
}

AddParams::_loadMetadata();
