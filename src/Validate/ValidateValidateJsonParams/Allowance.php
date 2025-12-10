<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidateJsonParams;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Allowance\ReasonCode;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Allowance\TaxCode;

/**
 * An allowance is a discount for example for early payment, volume discount, etc.
 *
 * @phpstan-type AllowanceShape = array{
 *   amount?: float|string|null,
 *   baseAmount?: float|string|null,
 *   multiplierFactor?: float|string|null,
 *   reason?: string|null,
 *   reasonCode?: value-of<ReasonCode>|null,
 *   taxCode?: value-of<\EInvoiceAPI\Validate\ValidateValidateJsonParams\Allowance\TaxCode>|null,
 *   taxRate?: float|string|null,
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
    public float|string|null $amount;

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    #[Optional('base_amount', nullable: true)]
    public float|string|null $baseAmount;

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20. Must be rounded to maximum 2 decimals.
     */
    #[Optional('multiplier_factor', nullable: true)]
    public float|string|null $multiplierFactor;

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
    #[Optional(
        'tax_code',
        enum: TaxCode::class,
    )]
    public ?string $taxCode;

    /**
     * The VAT rate, represented as percentage that applies to the allowance. Must be rounded to maximum 2 decimals.
     */
    #[Optional('tax_rate', nullable: true)]
    public float|string|null $taxRate;

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
        float|string|null $amount = null,
        float|string|null $baseAmount = null,
        float|string|null $multiplierFactor = null,
        ?string $reason = null,
        ReasonCode|string|null $reasonCode = null,
        TaxCode|string|null $taxCode = null,
        float|string|null $taxRate = null,
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $baseAmount && $self['baseAmount'] = $baseAmount;
        null !== $multiplierFactor && $self['multiplierFactor'] = $multiplierFactor;
        null !== $reason && $self['reason'] = $reason;
        null !== $reasonCode && $self['reasonCode'] = $reasonCode;
        null !== $taxCode && $self['taxCode'] = $taxCode;
        null !== $taxRate && $self['taxRate'] = $taxRate;

        return $self;
    }

    /**
     * The allowance amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(float|string|null $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    public function withBaseAmount(float|string|null $baseAmount): self
    {
        $self = clone $this;
        $self['baseAmount'] = $baseAmount;

        return $self;
    }

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20. Must be rounded to maximum 2 decimals.
     */
    public function withMultiplierFactor(
        float|string|null $multiplierFactor
    ): self {
        $self = clone $this;
        $self['multiplierFactor'] = $multiplierFactor;

        return $self;
    }

    /**
     * The reason for the allowance.
     */
    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Allowance reason codes for invoice discounts and charges.
     *
     * @param ReasonCode|value-of<ReasonCode>|null $reasonCode
     */
    public function withReasonCode(ReasonCode|string|null $reasonCode): self
    {
        $self = clone $this;
        $self['reasonCode'] = $reasonCode;

        return $self;
    }

    /**
     * The VAT category code that applies to the allowance.
     *
     * @param TaxCode|value-of<TaxCode> $taxCode
     */
    public function withTaxCode(
        TaxCode|string $taxCode,
    ): self {
        $self = clone $this;
        $self['taxCode'] = $taxCode;

        return $self;
    }

    /**
     * The VAT rate, represented as percentage that applies to the allowance. Must be rounded to maximum 2 decimals.
     */
    public function withTaxRate(float|string|null $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }
}
