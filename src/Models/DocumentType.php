<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class DocumentType implements StaticConverter
{
    use Enum;

    final public const INVOICE = 'INVOICE';

    final public const CREDIT_NOTE = 'CREDIT_NOTE';

    final public const DEBIT_NOTE = 'DEBIT_NOTE';
}

DocumentType::__introspect();
