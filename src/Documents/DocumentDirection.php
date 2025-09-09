<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

enum DocumentDirection: string
{
    case INBOUND = 'INBOUND';

    case OUTBOUND = 'OUTBOUND';
}
