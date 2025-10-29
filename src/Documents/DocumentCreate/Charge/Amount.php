<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate\Charge;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * The charge amount, without VAT. Must be rounded to maximum 2 decimals.
 */
final class Amount implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
