<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox\InboxListCreditNotesParams;

/**
 * Sort direction (asc/desc).
 */
enum SortOrder: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
