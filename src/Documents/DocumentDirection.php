<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type document_direction_alias = DocumentDirection::*
 */
final class DocumentDirection implements ConverterSource
{
    use Enum;

    public const INBOUND = 'INBOUND';

    public const OUTBOUND = 'OUTBOUND';
}
