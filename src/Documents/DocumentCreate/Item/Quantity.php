<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate\Item;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type quantity_alias = float|string|null
 */
final class Quantity implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
