<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

use EInvoiceAPI\Core\Serde\CoerceState;
use EInvoiceAPI\Core\Serde\DumpState;

interface Converter
{
    public function coerce(mixed $value, CoerceState $state): mixed;

    public function dump(mixed $value, DumpState $state): mixed;
}
