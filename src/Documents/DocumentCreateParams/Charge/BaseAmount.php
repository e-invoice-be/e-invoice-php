<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreateParams\Charge;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * The base amount that may be used, in conjunction with the charge percentage, to calculate the charge amount. Must be rounded to maximum 2 decimals.
 */
final class BaseAmount implements ConverterSource
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
