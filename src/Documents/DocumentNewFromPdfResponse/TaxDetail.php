<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentNewFromPdfResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type TaxDetailShape = array{amount?: string|null, rate?: string|null}
 */
final class TaxDetail implements BaseModel
{
    /** @use SdkModel<TaxDetailShape> */
    use SdkModel;

    /**
     * The tax amount for this tax category. Must be rounded to maximum 2 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $amount;

    /**
     * The tax rate as a percentage (e.g., '21.00', '6.00', '0.00').
     */
    #[Optional(nullable: true)]
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
        ?string $amount = null,
        ?string $rate = null
    ): self {
        $obj = new self;

        null !== $amount && $obj['amount'] = $amount;
        null !== $rate && $obj['rate'] = $rate;

        return $obj;
    }

    /**
     * The tax amount for this tax category. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(?string $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The tax rate as a percentage (e.g., '21.00', '6.00', '0.00').
     */
    public function withRate(?string $rate): self
    {
        $obj = clone $this;
        $obj['rate'] = $rate;

        return $obj;
    }
}
