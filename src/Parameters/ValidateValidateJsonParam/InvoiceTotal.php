<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\ValidateValidateJsonParam;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class InvoiceTotal implements StaticConverter
{
    use Union;
}

InvoiceTotal::__introspect();
