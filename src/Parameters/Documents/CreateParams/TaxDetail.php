<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\CreateParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class TaxDetail implements BaseModel
{
    use Model;

    #[Api(optional: true)]
    public null|float|string $amount;

    #[Api(optional: true)]
    public ?string $rate;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        null|float|string $amount = null,
        ?string $rate = null
    ) {
        $this->amount = $amount;
        $this->rate = $rate;
    }
}

TaxDetail::__introspect();
