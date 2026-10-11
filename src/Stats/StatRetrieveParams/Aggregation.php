<?php

declare(strict_types=1);

namespace EInvoiceAPI\Stats\StatRetrieveParams;

/**
 * Aggregation type: DAY, WEEK, or MONTH. Defaults to DAY.
 */
enum Aggregation: string
{
    case DAY = 'DAY';

    case WEEK = 'WEEK';

    case MONTH = 'MONTH';
}
