<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

class DocumentState
{
    final public const DRAFT = 'DRAFT';

    final public const TRANSIT = 'TRANSIT';

    final public const FAILED = 'FAILED';

    final public const SENT = 'SENT';

    final public const RECEIVED = 'RECEIVED';
}
