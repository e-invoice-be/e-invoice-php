<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreateParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentCreateParams\Charge\ReasonCode;
use EInvoiceAPI\Documents\DocumentCreateParams\Charge\TaxCode;

/**
 * A charge is an additional fee for example for late payment, late delivery, etc.
 *
 * @phpstan-type ChargeShape = array{
 *   amount?: float|string|null,
 *   base_amount?: float|string|null,
 *   multiplier_factor?: float|string|null,
 *   reason?: string|null,
 *   reason_code?: value-of<ReasonCode>|null,
 *   tax_code?: value-of<\EInvoiceAPI\Documents\DocumentCreateParams\Charge\TaxCode>|null,
 *   tax_rate?: float|string|null,
 * }
 */
final class Charge implements BaseModel
{
    /** @use SdkModel<ChargeShape> */
    use SdkModel;

    /**
     * The charge amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $amount;

    /**
     * The base amount that may be used, in conjunction with the charge percentage, to calculate the charge amount. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $base_amount;

    /**
     * The percentage that may be used, in conjunction with the charge base amount, to calculate the charge amount. To state 20%, use value 20.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $multiplier_factor;

    /**
     * The reason for the charge.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $reason;

    /**
     * Charge reason codes for invoice charges and fees.
     *
     * @var value-of<ReasonCode>|null $reason_code
     */
    #[Api(enum: ReasonCode::class, nullable: true, optional: true)]
    public ?string $reason_code;

    /**
     * Duty or tax or fee category codes (Subset of UNCL5305).
     *
     * Agency: UN/CEFACT
     * Version: D.16B
     * Subset: OpenPEPPOL
     *
     * @var value-of<TaxCode>|null $tax_code
     */
    #[Api(
        enum: TaxCode::class,
        nullable: true,
        optional: true,
    )]
    public ?string $tax_code;

    /**
     * The VAT rate, represented as percentage that applies to the charge.
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
     * @param TaxCode|value-of<TaxCode>|null $tax_code
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

        null !== $amount && $obj->amount = $amount;
        null !== $base_amount && $obj->base_amount = $base_amount;
        null !== $multiplier_factor && $obj->multiplier_factor = $multiplier_factor;
        null !== $reason && $obj->reason = $reason;
        null !== $reason_code && $obj['reason_code'] = $reason_code;
        null !== $tax_code && $obj['tax_code'] = $tax_code;
        null !== $tax_rate && $obj->tax_rate = $tax_rate;

        return $obj;
    }

    /**
     * The charge amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(float|string|null $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * The base amount that may be used, in conjunction with the charge percentage, to calculate the charge amount. Must be rounded to maximum 2 decimals.
     */
    public function withBaseAmount(float|string|null $baseAmount): self
    {
        $obj = clone $this;
        $obj->base_amount = $baseAmount;

        return $obj;
    }

    /**
     * The percentage that may be used, in conjunction with the charge base amount, to calculate the charge amount. To state 20%, use value 20.
     */
    public function withMultiplierFactor(
        float|string|null $multiplierFactor
    ): self {
        $obj = clone $this;
        $obj->multiplier_factor = $multiplierFactor;

        return $obj;
    }

    /**
     * The reason for the charge.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }

    /**
     * Charge reason codes for invoice charges and fees.
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
     * Duty or tax or fee category codes (Subset of UNCL5305).
     *
     * Agency: UN/CEFACT
     * Version: D.16B
     * Subset: OpenPEPPOL
     *
     * @param TaxCode|value-of<TaxCode>|null $taxCode
     */
    public function withTaxCode(
        TaxCode|string|null $taxCode,
    ): self {
        $obj = clone $this;
        $obj['tax_code'] = $taxCode;

        return $obj;
    }

    /**
     * The VAT rate, represented as percentage that applies to the charge.
     */
    public function withTaxRate(float|string|null $taxRate): self
    {
        $obj = clone $this;
        $obj->tax_rate = $taxRate;

        return $obj;
    }
}
