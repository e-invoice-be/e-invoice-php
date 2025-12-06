<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentCreate\Allowance\ReasonCode;
use EInvoiceAPI\Documents\DocumentCreate\Allowance\TaxCode;

/**
 * An allowance is a discount for example for early payment, volume discount, etc.
 *
 * @phpstan-type AllowanceShape = array{
 *   amount?: float|string|null,
 *   base_amount?: float|string|null,
 *   multiplier_factor?: float|string|null,
 *   reason?: string|null,
 *   reason_code?: value-of<ReasonCode>|null,
 *   tax_code?: value-of<\EInvoiceAPI\Documents\DocumentCreate\Allowance\TaxCode>|null,
 *   tax_rate?: float|string|null,
 * }
 */
final class Allowance implements BaseModel
{
    /** @use SdkModel<AllowanceShape> */
    use SdkModel;

    /**
     * The allowance amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $amount;

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $base_amount;

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $multiplier_factor;

    /**
     * The reason for the allowance.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $reason;

    /**
     * Allowance reason codes for invoice discounts and charges.
     *
     * @var value-of<ReasonCode>|null $reason_code
     */
    #[Api(enum: ReasonCode::class, nullable: true, optional: true)]
    public ?string $reason_code;

    /**
     * The VAT category code that applies to the allowance.
     *
     * @var value-of<TaxCode>|null $tax_code
     */
    #[Api(
        enum: TaxCode::class,
        optional: true,
    )]
    public ?string $tax_code;

    /**
     * The VAT rate, represented as percentage that applies to the allowance. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $tax_rate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ReasonCode|value-of<ReasonCode>|null $reason_code
     * @param TaxCode|value-of<TaxCode> $tax_code
     */
    public static function with(
        float|string|null $amount = null,
        float|string|null $base_amount = null,
        float|string|null $multiplier_factor = null,
        ?string $reason = null,
        ReasonCode|string|null $reason_code = null,
        TaxCode|string|null $tax_code = null,
        float|string|null $tax_rate = null,
    ): self {
        $obj = new self;

        null !== $amount && $obj['amount'] = $amount;
        null !== $base_amount && $obj['base_amount'] = $base_amount;
        null !== $multiplier_factor && $obj['multiplier_factor'] = $multiplier_factor;
        null !== $reason && $obj['reason'] = $reason;
        null !== $reason_code && $obj['reason_code'] = $reason_code;
        null !== $tax_code && $obj['tax_code'] = $tax_code;
        null !== $tax_rate && $obj['tax_rate'] = $tax_rate;

        return $obj;
    }

    /**
     * The allowance amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(float|string|null $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    public function withBaseAmount(float|string|null $baseAmount): self
    {
        $obj = clone $this;
        $obj['base_amount'] = $baseAmount;

        return $obj;
    }

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20. Must be rounded to maximum 2 decimals.
     */
    public function withMultiplierFactor(
        float|string|null $multiplierFactor
    ): self {
        $obj = clone $this;
        $obj['multiplier_factor'] = $multiplierFactor;

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
        $obj['reason_code'] = $reasonCode;

        return $obj;
    }

    /**
     * The VAT category code that applies to the allowance.
     *
     * @param TaxCode|value-of<TaxCode> $taxCode
     */
    public function withTaxCode(
        TaxCode|string $taxCode
    ): self {
        $obj = clone $this;
        $obj['tax_code'] = $taxCode;

        return $obj;
    }

    /**
     * The VAT rate, represented as percentage that applies to the allowance. Must be rounded to maximum 2 decimals.
     */
    public function withTaxRate(float|string|null $taxRate): self
    {
        $obj = clone $this;
        $obj['tax_rate'] = $taxRate;

        return $obj;
    }
}
