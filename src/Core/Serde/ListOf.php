<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Serde;

use EInvoiceAPI\Core\Concerns\ArrayOf;
use EInvoiceAPI\Core\Contracts\Converter;

final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line
    private function empty(): array|object
    {
        return [];
    }
}
