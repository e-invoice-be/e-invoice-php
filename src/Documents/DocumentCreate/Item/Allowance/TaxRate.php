<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate\Item\Allowance;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * The VAT rate, represented as percentage that applies to the allowance. Must be rounded to maximum 2 decimals.
 */
final class TaxRate implements ConverterSource
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
