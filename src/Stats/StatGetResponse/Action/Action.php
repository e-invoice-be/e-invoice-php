<?php

declare(strict_types=1);

namespace EInvoiceAPI\Stats\StatGetResponse\Action;

/**
 * Type of action.
 */
enum Action: string
{
    case DOCUMENT_SENT = 'DOCUMENT_SENT';

    case DOCUMENT_RECEIVED = 'DOCUMENT_RECEIVED';
}
