<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Concerns\SdkEnum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class DocumentState implements ConverterSource
{
    use SdkEnum;

    public const DRAFT = 'DRAFT';

    public const TRANSIT = 'TRANSIT';

    public const FAILED = 'FAILED';

    public const SENT = 'SENT';

    public const RECEIVED = 'RECEIVED';
}
