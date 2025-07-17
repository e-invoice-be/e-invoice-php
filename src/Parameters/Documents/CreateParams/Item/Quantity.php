<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\CreateParams\Item;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class Quantity implements StaticConverter
{
    use Union;
}

Quantity::__introspect();
