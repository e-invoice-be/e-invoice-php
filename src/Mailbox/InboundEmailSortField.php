<?php

declare(strict_types=1);

namespace EInvoiceAPI\Mailbox;

enum InboundEmailSortField: string
{
    case RECEIVED_AT = 'received_at';

    case CREATED_AT = 'created_at';
}
