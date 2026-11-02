<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Conversion;

use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;

/**
 * A field with the `date` format (no time). Its values go out in the RFC 3339 format with a precision of one second,
 * unlike `date-time` values, which keep their fractions of a second.
 *
 * @internal
 */
final class DateOf implements Converter
{
    public function coerce(mixed $value, CoerceState $state): mixed
    {
        return Conversion::coerce(\DateTimeInterface::class, value: $value, state: $state);
    }

    public function dump(mixed $value, DumpState $state): mixed
    {
        if ($value instanceof \DateTimeInterface) {
            ++$state->yes;

            return $value->format(format: \DateTimeInterface::RFC3339);
        }

        return Conversion::dump_unknown($value, state: $state);
    }
}
