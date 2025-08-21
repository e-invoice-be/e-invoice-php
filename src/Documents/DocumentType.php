<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Concerns\SdkEnum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type document_type_alias = DocumentType::*
 */
final class DocumentType implements ConverterSource
{
    use SdkEnum;

    public const INVOICE = 'INVOICE';

    public const CREDIT_NOTE = 'CREDIT_NOTE';

    public const DEBIT_NOTE = 'DEBIT_NOTE';
}
