<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentCreate;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\Converter;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class InvoiceTotal implements StaticConverter
{
    use Union;

    /**
     * @return list<string|Converter|StaticConverter>|array<
     *   string, string|Converter|StaticConverter
     * >
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
