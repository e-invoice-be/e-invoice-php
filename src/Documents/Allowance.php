<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Allowance\ReasonCode;
use EInvoiceAPI\Documents\Allowance\TaxCode;

/**
 * An allowance is a discount for example for early payment, volume discount, etc.
 *
 * @phpstan-type AllowanceShape = array{
 *   amount?: string|null,
 *   baseAmount?: string|null,
 *   multiplierFactor?: string|null,
 *   reason?: string|null,
 *   reasonCode?: value-of<ReasonCode>|null,
 *   taxCode?: value-of<TaxCode>|null,
 *   taxRate?: string|null,
 * }
 */
final class Allowance implements BaseModel
{
    /** @use SdkModel<AllowanceShape> */
    use SdkModel;

    /**
     * The allowance amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $amount;

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    #[Optional('base_amount', nullable: true)]
    public ?string $baseAmount;

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20. Must be rounded to maximum 2 decimals.
     */
    #[Optional('multiplier_factor', nullable: true)]
    public ?string $multiplierFactor;

    /**
     * The reason for the allowance.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * Allowance reason codes for invoice discounts and charges.
     *
     * @var value-of<ReasonCode>|null $reasonCode
     */
    #[Optional('reason_code', enum: ReasonCode::class, nullable: true)]
    public ?string $reasonCode;

    /**
     * The VAT category code that applies to the allowance.
     *
     * @var value-of<TaxCode>|null $taxCode
     */
    #[Optional('tax_code', enum: TaxCode::class)]
    public ?string $taxCode;

    /**
     * The VAT rate, represented as percentage that applies to the allowance. Must be rounded to maximum 2 decimals.
     */
    #[Optional('tax_rate', nullable: true)]
    public ?string $taxRate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ReasonCode|value-of<ReasonCode>|null $reasonCode
     * @param TaxCode|value-of<TaxCode> $taxCode
     */
    public static function with(
        ?string $amount = null,
        ?string $baseAmount = null,
        ?string $multiplierFactor = null,
        ?string $reason = null,
        ReasonCode|string|null $reasonCode = null,
        TaxCode|string|null $taxCode = null,
        ?string $taxRate = null,
    ): self {
        $obj = new self;

        null !== $amount && $obj['amount'] = $amount;
        null !== $baseAmount && $obj['baseAmount'] = $baseAmount;
        null !== $multiplierFactor && $obj['multiplierFactor'] = $multiplierFactor;
        null !== $reason && $obj['reason'] = $reason;
        null !== $reasonCode && $obj['reasonCode'] = $reasonCode;
        null !== $taxCode && $obj['taxCode'] = $taxCode;
        null !== $taxRate && $obj['taxRate'] = $taxRate;

        return $obj;
    }

    /**
     * The allowance amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(?string $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    public function withBaseAmount(?string $baseAmount): self
    {
        $obj = clone $this;
        $obj['baseAmount'] = $baseAmount;

        return $obj;
    }

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20. Must be rounded to maximum 2 decimals.
     */
    public function withMultiplierFactor(?string $multiplierFactor): self
    {
        $obj = clone $this;
        $obj['multiplierFactor'] = $multiplierFactor;

        return $obj;
    }

    /**
     * The reason for the allowance.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }

    /**
     * Allowance reason codes for invoice discounts and charges.
     *
     * @param ReasonCode|value-of<ReasonCode>|null $reasonCode
     */
    public function withReasonCode(ReasonCode|string|null $reasonCode): self
    {
        $obj = clone $this;
        $obj['reasonCode'] = $reasonCode;

        return $obj;
    }

    /**
     * The VAT category code that applies to the allowance.
     *
     * @param TaxCode|value-of<TaxCode> $taxCode
     */
    public function withTaxCode(TaxCode|string $taxCode): self
    {
        $obj = clone $this;
        $obj['taxCode'] = $taxCode;

        return $obj;
    }

    /**
     * The VAT rate, represented as percentage that applies to the allowance. Must be rounded to maximum 2 decimals.
     */
    public function withTaxRate(?string $taxRate): self
    {
        $obj = clone $this;
        $obj['taxRate'] = $taxRate;

        return $obj;
    }
}
