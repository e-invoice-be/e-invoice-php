<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

use EInvoiceAPI\Core\Serde\CoerceState;
use EInvoiceAPI\Core\Serde\DumpState;

interface StaticConverter
{
    public static function coerce(mixed $value, CoerceState $state): mixed;

    public static function dump(mixed $value, DumpState $state): mixed;
}
