<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Validate\ValidateJsonParams\Item;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class UnitPrice implements StaticConverter
{
    use Union;
}

UnitPrice::__introspect();
