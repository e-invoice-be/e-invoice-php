<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

/**
 * @internal
 */
interface Introspectable
{
    /**
     * @internal
     */
    public static function introspect(): void;
}
