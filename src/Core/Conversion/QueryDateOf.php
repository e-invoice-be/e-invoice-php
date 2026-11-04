<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Conversion;

use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;

/**
 * A query parameter with the `date` format that also accepts a string. A `\DateTimeInterface` goes out as `Y-m-d`,
 * the calendar date in its own time zone. Anything else is coerced as a string and goes out as given.
 *
 * @internal
 */
final class QueryDateOf implements Converter
{
    public function coerce(mixed $value, CoerceState $state): mixed
    {
        if ($value instanceof \DateTimeInterface) {
            ++$state->yes;

            return $value;
        }

        return Conversion::coerce('string', value: $value, state: $state);
    }

    public function dump(mixed $value, DumpState $state): mixed
    {
        if ($value instanceof \DateTimeInterface) {
            ++$state->yes;

            return $value->format(format: 'Y-m-d');
        }

        return Conversion::dump_unknown($value, state: $state);
    }
}
