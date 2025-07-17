<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class DocumentDirection implements StaticConverter
{
    use Enum;

    final public const INBOUND = 'INBOUND';

    final public const OUTBOUND = 'OUTBOUND';
}

DocumentDirection::__introspect();
