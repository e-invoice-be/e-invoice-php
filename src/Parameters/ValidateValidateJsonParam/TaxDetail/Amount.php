<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\ValidateValidateJsonParam\TaxDetail;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type amount_alias = float|string|null
 */
final class Amount implements ConverterSource
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
