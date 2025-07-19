<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

use EInvoiceAPI\Core\Conversion\CoerceState;
use EInvoiceAPI\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
