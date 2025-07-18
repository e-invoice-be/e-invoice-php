<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Concerns;

use EInvoiceAPI\Core\Serde\CoerceState;
use EInvoiceAPI\Core\Serde\DumpState;

trait Enum
{
    public static function introspect(): void {}

    public static function coerce(mixed $value, CoerceState $state): mixed
    {
        return $value;
    }

    public static function dump(mixed $value, DumpState $state): mixed
    {
        return $value;
    }
}
