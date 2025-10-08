<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate\Allowance;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20.
 */
final class MultiplierFactor implements ConverterSource
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
