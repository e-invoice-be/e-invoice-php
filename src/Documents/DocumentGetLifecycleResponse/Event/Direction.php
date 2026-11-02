<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event;

enum Direction: string
{
    case IN = 'in';

    case OUT = 'out';
}
