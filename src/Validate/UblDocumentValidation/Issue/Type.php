<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\UblDocumentValidation\Issue;

use EInvoiceAPI\Core\Concerns\SdkEnum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const ERROR = 'error';

    public const WARNING = 'warning';
}
