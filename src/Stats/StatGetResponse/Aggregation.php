<?php

declare(strict_types=1);

namespace EInvoiceAPI\Stats\StatGetResponse;

/**
 * Aggregation type used.
 */
enum Aggregation: string
{
    case DAY = 'DAY';

    case WEEK = 'WEEK';

    case MONTH = 'MONTH';
}
