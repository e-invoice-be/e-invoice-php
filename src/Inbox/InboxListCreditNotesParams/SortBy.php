<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox\InboxListCreditNotesParams;

/**
 * Field to sort by.
 */
enum SortBy: string
{
    case CREATED_AT = 'created_at';

    case INVOICE_DATE = 'invoice_date';

    case DUE_DATE = 'due_date';

    case INVOICE_TOTAL = 'invoice_total';

    case CUSTOMER_NAME = 'customer_name';

    case VENDOR_NAME = 'vendor_name';

    case INVOICE_ID = 'invoice_id';
}
