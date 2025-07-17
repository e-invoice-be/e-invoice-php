<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\CreateParams;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class TotalDiscount implements StaticConverter
{
    use Union;
}

TotalDiscount::__introspect();
