<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;

/**
 * Sort direction (asc/desc).
 */
enum SortOrder: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
