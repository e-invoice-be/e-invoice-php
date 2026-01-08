<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * The VAT rate of the line item expressed as percentage with 2 decimals.
 *
 * @phpstan-type TaxRateVariants = float|string
 * @phpstan-type TaxRateShape = TaxRateVariants
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
