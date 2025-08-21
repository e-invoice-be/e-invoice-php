<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreateParams;

use EInvoiceAPI\Core\Concerns\SdkUnion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type subtotal_alias = float|string|null
 */
final class Subtotal implements ConverterSource
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
