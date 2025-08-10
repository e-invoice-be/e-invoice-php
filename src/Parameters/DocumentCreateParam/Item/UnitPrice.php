<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\DocumentCreateParam\Item;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type unit_price_alias = float|string|null
 */
final class UnitPrice implements ConverterSource
{
    use Union;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
