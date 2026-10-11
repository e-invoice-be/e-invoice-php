<?php

declare(strict_types=1);

namespace EInvoiceAPI\Mailbox;

enum InboundEmailStatus: string
{
    case PENDING = 'pending';

    case SUCCESS = 'success';

    case FAILED = 'failed';
}
