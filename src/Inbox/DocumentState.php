<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type document_state_alias = DocumentState::*
 */
final class DocumentState implements ConverterSource
{
    use Enum;

    public const DRAFT = 'DRAFT';

    public const TRANSIT = 'TRANSIT';

    public const FAILED = 'FAILED';

    public const SENT = 'SENT';

    public const RECEIVED = 'RECEIVED';
}
