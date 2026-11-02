<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event;

enum Level: string
{
    case TRANSPORT = 'transport';

    case BUSINESS = 'business';
}
