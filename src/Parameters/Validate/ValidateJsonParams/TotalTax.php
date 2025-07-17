<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Validate\ValidateJsonParams;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class TotalTax implements StaticConverter
{
    use Union;
}

TotalTax::__introspect();
