<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

use EInvoiceAPI\Core\Serde\CoerceState;
use EInvoiceAPI\Core\Serde\DumpState;

/**
 * @internal
 */
interface StaticConverter extends Introspectable
{
    /**
     * @internal
     */
    public static function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public static function dump(mixed $value, DumpState $state): mixed;
}
