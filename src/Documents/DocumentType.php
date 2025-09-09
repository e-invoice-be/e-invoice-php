<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

enum DocumentType: string
{
    case INVOICE = 'INVOICE';

    case CREDIT_NOTE = 'CREDIT_NOTE';

    case DEBIT_NOTE = 'DEBIT_NOTE';
}
