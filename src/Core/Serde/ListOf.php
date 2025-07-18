<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Serde;

use EInvoiceAPI\Core\Concerns\ArrayOf;
use EInvoiceAPI\Core\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    private function empty(): array|object // @phpstan-ignore-line
    {
        return [];
    }
}
