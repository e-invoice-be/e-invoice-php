<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\UblDocumentValidation\Issue;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class Type implements StaticConverter
{
    use Enum;

    final public const ERROR = 'error';

    final public const WARNING = 'warning';
}

Type::__introspect();
