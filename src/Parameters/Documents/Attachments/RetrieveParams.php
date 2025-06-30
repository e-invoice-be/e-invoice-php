<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class RetrieveParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $documentID;
}

RetrieveParams::_loadMetadata();
