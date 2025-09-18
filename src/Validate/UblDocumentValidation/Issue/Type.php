<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\UblDocumentValidation\Issue;

enum Type: string
{
    case ERROR = 'error';

    case WARNING = 'warning';
}
