<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\DocumentCreateParam;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class TotalDiscount implements StaticConverter
{
    use Union;
}
