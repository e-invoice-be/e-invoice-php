<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\UblDocumentValidation\Issue;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const ERROR = 'error';

    public const WARNING = 'warning';
}
