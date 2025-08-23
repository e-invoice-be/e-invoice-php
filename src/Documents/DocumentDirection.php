<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Concerns\SdkEnum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class DocumentDirection implements ConverterSource
{
    use SdkEnum;

    public const INBOUND = 'INBOUND';

    public const OUTBOUND = 'OUTBOUND';
}
