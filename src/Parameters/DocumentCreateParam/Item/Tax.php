<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\DocumentCreateParam\Item;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class Tax implements StaticConverter
{
    use Union;
}

Tax::__introspect();
