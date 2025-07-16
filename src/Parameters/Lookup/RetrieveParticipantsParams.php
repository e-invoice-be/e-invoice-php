<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class RetrieveParticipantsParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $query;

    #[Api(optional: true)]
    public ?string $countryCode;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $query, ?string $countryCode = null)
    {
        $this->query = $query;
        $this->countryCode = $countryCode;
    }
}

RetrieveParticipantsParams::_loadMetadata();
