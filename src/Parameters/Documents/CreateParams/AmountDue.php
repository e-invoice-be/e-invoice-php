<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\CreateParams;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class AmountDue implements StaticConverter
{
    use Union;
}

AmountDue::__introspect();
