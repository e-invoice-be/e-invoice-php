<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class RetrieveParticipantsParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $query;

    #[Api(optional: true)]
    public ?string $countryCode;
}

RetrieveParticipantsParams::_loadMetadata();
