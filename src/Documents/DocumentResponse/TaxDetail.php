<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentResponse;

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
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $rate && $self['rate'] = $rate;

        return $self;
    }

    /**
     * The tax amount for this tax category. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(?string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The tax rate as a percentage (e.g., '21.00', '6.00', '0.00').
     */
    public function withRate(?string $rate): self
    {
        $self = clone $this;
        $self['rate'] = $rate;

        return $self;
    }
}
