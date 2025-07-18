<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class LookupRetrieveParam implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $peppolID;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $peppolID)
    {
        self::introspect();

        $this->peppolID = $peppolID;
    }
}
