<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type document_type_alias = DocumentType::*
 */
final class DocumentType implements ConverterSource
{
    use Enum;

    public const INVOICE = 'INVOICE';

    public const CREDIT_NOTE = 'CREDIT_NOTE';

    public const DEBIT_NOTE = 'DEBIT_NOTE';
}
