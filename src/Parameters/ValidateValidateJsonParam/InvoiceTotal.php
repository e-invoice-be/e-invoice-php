<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\ValidateValidateJsonParam;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type invoice_total_alias = float|string|null
 */
final class InvoiceTotal implements ConverterSource
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
