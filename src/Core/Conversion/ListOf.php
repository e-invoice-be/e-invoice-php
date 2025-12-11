<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Conversion;

use EInvoiceAPI\Core\Conversion\Concerns\ArrayOf;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
