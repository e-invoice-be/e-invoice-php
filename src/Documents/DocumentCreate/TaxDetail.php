<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type tax_detail_alias = array{
 *   amount?: float|string|null, rate?: string|null
 * }
 */
final class TaxDetail implements BaseModel
{
    use SdkModel;

    #[Api(optional: true)]
    public null|float|string $amount;

    #[Api(optional: true)]
    public ?string $rate;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        null|float|string $amount = null,
        ?string $rate = null
    ): self {
        $obj = new self;

        null !== $amount && $obj->amount = $amount;
        null !== $rate && $obj->rate = $rate;

        return $obj;
    }

    public function withAmount(null|float|string $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    public function withRate(?string $rate): self
    {
        $obj = clone $this;
        $obj->rate = $rate;

        return $obj;
    }
}
