<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentCreate\Item;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class UnitPrice implements ConverterSource
{
    use Union;

    /**
     * @return list<string|Converter|ConverterSource>|array<
     *   string, string|Converter|ConverterSource
     * >
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
