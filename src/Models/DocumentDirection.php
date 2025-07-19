<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class DocumentDirection implements ConverterSource
{
    use Enum;

    final public const INBOUND = 'INBOUND';

    final public const OUTBOUND = 'OUTBOUND';
}
