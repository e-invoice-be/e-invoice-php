<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Concerns;

use EInvoiceAPI\Core\Contracts\Converter;
use EInvoiceAPI\Core\Contracts\StaticConverter;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Core\Serde\CoerceState;
use EInvoiceAPI\Core\Serde\DumpState;

trait ArrayOf
{
    public function __construct(
        private readonly string|Converter|StaticConverter $type,
        private readonly bool $nullable = false,
    ) {
    }

    public function coerce(mixed $value, CoerceState $state): mixed
    {
        if (!is_array($value)) {
            return $value;
        }

        $acc = [];
        foreach ($value as $k => $v) {
            if ($this->nullable && null === $v) {
                ++$state->yes;
                $acc[$k] = null;
            } else {
                $acc[$k] = Serde::coerce($this->type, value: $v, state: $state);
            }
        }

        return $acc;
    }

    public function dump(mixed $value, DumpState $state): mixed
    {
        if (!is_array($value)) {
            return Serde::dump_unknown($value, state: $state);
        }

        return array_map(fn ($v) => Serde::dump($this->type, value: $v, state: $state), array: $value);
    }
}
