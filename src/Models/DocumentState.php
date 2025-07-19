<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class DocumentState implements ConverterSource
{
    use Enum;

    final public const DRAFT = 'DRAFT';

    final public const TRANSIT = 'TRANSIT';

    final public const FAILED = 'FAILED';

    final public const SENT = 'SENT';

    final public const RECEIVED = 'RECEIVED';
}
