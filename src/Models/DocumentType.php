<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

class DocumentType
{
    final public const INVOICE = 'INVOICE';

    final public const CREDIT_NOTE = 'CREDIT_NOTE';

    final public const DEBIT_NOTE = 'DEBIT_NOTE';
}
