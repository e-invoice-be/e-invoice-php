<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @internal
 *
 * @extends \ArrayAccess<string, mixed>
 */
interface BaseModel extends \ArrayAccess, \JsonSerializable, \Stringable, ConverterSource
{
    /** @return array<string, mixed> */
    public function toProperties(): array;
}
