<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Attributes;

use EInvoiceAPI\Core\Contracts\Converter;
use EInvoiceAPI\Core\Contracts\StaticConverter;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Api
{
    /**
     * @param ?array<string|int,string|Converter|StaticConverter> $union
     */
    public function __construct(
        public ?string $apiName = null,
        public string|Converter|StaticConverter|null $type = null,
        public bool $optional = false,
        public ?string $discriminator = null,
        public ?array $union = null,
    ) {
    }
}
