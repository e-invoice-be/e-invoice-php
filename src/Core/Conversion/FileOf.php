<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Conversion;

use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\FileParam;

/**
 * @internal
 */
final class FileOf implements Converter
{
    public function coerce(mixed $value, CoerceState $state): mixed
    {
        if ($value instanceof FileParam || is_string($value)) {
            ++$state->yes;
        } else {
            ++$state->no;
        }

        return $value;
    }

    public function dump(mixed $value, DumpState $state): mixed
    {
        if ($value instanceof FileParam) {
            ++$state->yes;

            return $value;
        }

        if (is_string($value)) {
            ++$state->yes;

            return FileParam::fromString($value);
        }

        ++$state->no;

        return Conversion::dump_unknown($value, state: $state);
    }
}
