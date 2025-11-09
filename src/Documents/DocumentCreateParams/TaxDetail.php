<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreateParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type TaxDetailShape = array{
 *   amount?: float|string|null, rate?: string|null
 * }
 */
final class TaxDetail implements BaseModel
{
    /** @use SdkModel<TaxDetailShape> */
    use SdkModel;

    /**
     * The tax amount for this tax category. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $amount;

    /**
     * The tax rate as a percentage (e.g., '21.00', '6.00', '0.00').
     */
    #[Api(nullable: true, optional: true)]
    public ?string $rate;

    public function __construct()
    {
        $this->initialize();
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

    /**
     * The tax amount for this tax category. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(float|string|null $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * The tax rate as a percentage (e.g., '21.00', '6.00', '0.00').
     */
    public function withRate(?string $rate): self
    {
        $obj = clone $this;
        $obj->rate = $rate;

        return $obj;
    }
}
