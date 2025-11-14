<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate\Item;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * The item price base quantity (BT-149). The number of item units to which the price applies. Defaults to 1. Must be rounded to maximum 4 decimals.
 */
final class PriceBaseQuantity implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
