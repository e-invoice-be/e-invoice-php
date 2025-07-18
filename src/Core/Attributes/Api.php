<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Attributes;

use EInvoiceAPI\Core\Contracts\Converter;
use EInvoiceAPI\Core\Contracts\StaticConverter;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Api
{
    /**
     * @param ?array<int|string,Converter|StaticConverter|string> $union
     */
    public function __construct(
        public ?string $apiName = null,
        public null|Converter|StaticConverter|string $type = null,
        public null|Converter|StaticConverter|string $enum = null,
        public null|Converter|StaticConverter|string $union = null,
        private readonly bool $nullable = false,
        public bool $optional = false,
    ) {}
}
