<?php

declare(strict_types=1);

namespace EInvoiceAPI\Conversion;

enum DocumentCreateFromPdfTaskStatus: string
{
    case PENDING = 'pending';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
