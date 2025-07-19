<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Conversion;

use EInvoiceAPI\Core\Concerns\ArrayOf;
use EInvoiceAPI\Core\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
