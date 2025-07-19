<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\UblDocumentValidation\Issue;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use Enum;

    final public const ERROR = 'error';

    final public const WARNING = 'warning';
}
