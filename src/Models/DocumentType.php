<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class DocumentType implements ConverterSource
{
    use Enum;

    final public const INVOICE = 'INVOICE';

    final public const CREDIT_NOTE = 'CREDIT_NOTE';

    final public const DEBIT_NOTE = 'DEBIT_NOTE';
}
