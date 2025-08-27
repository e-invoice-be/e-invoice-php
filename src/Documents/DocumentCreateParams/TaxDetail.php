<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreateParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type tax_detail = array{amount?: float|string|null, rate?: string|null}
 */
final class TaxDetail implements BaseModel
{
    /** @use SdkModel<tax_detail> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public float|string|null $amount;

    #[Api(nullable: true, optional: true)]
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
        float|string|null $amount = null,
        ?string $rate = null
    ): self {
        $obj = new self;

        null !== $amount && $obj->amount = $amount;
        null !== $rate && $obj->rate = $rate;

        return $obj;
    }

    public function withAmount(float|string|null $amount): self
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
