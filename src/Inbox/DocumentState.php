<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

enum DocumentState: string
{
    case DRAFT = 'DRAFT';

    case TRANSIT = 'TRANSIT';

    case FAILED = 'FAILED';

    case SENT = 'SENT';

    case RECEIVED = 'RECEIVED';
}
