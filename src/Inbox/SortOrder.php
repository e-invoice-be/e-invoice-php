<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

/**
 * Sort order options.
 */
enum SortOrder: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
