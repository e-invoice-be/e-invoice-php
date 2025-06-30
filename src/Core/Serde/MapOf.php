<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Serde;

use EInvoiceAPI\Core\Concerns\ArrayOf;
use EInvoiceAPI\Core\Contracts\Converter;

final class MapOf implements Converter
{
    use ArrayOf;
}
