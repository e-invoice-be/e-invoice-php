<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreateParams\Item;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentCreateParams\Item\Charge\ReasonCode;
use EInvoiceAPI\Documents\DocumentCreateParams\Item\Charge\TaxCode;

/**
 * A charge is an additional fee for example for late payment, late delivery, etc.
 *
 * @phpstan-type ChargeShape = array{
 *   amount?: float|string|null,
 *   baseAmount?: float|string|null,
 *   multiplierFactor?: float|string|null,
 *   reason?: string|null,
 *   reasonCode?: value-of<ReasonCode>|null,
 *   taxCode?: value-of<TaxCode>|null,
 *   taxRate?: float|string|null,
 * }
 */
final class Charge implements BaseModel
{
    /** @use SdkModel<ChargeShape> */
    use SdkModel;

    /**
     * The charge amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    #[Optional(nullable: true)]
    public float|string|null $amount;

    /**
     * The base amount that may be used, in conjunction with the charge percentage, to calculate the charge amount. Must be rounded to maximum 2 decimals.
     */
    #[Optional('base_amount', nullable: true)]
    public float|string|null $baseAmount;

    /**
     * The percentage that may be used, in conjunction with the charge base amount, to calculate the charge amount. To state 20%, use value 20.
     */
    #[Optional('multiplier_factor', nullable: true)]
    public float|string|null $multiplierFactor;

    /**
     * The reason for the charge.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * Charge reason codes for invoice charges and fees.
     *
     * @var value-of<ReasonCode>|null $reasonCode
     */
    #[Optional('reason_code', enum: ReasonCode::class, nullable: true)]
    public ?string $reasonCode;

    /**
     * Duty or tax or fee category codes (Subset of UNCL5305).
     *
     * Agency: UN/CEFACT
     * Version: D.16B
     * Subset: OpenPEPPOL
     *
     * @var value-of<TaxCode>|null $taxCode
     */
    #[Optional('tax_code', enum: TaxCode::class, nullable: true)]
    public ?string $taxCode;

    /**
     * The VAT rate, represented as percentage that applies to the charge.
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
     * @param TaxCode|value-of<TaxCode>|null $taxCode
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
     * The charge amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(float|string|null $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The base amount that may be used, in conjunction with the charge percentage, to calculate the charge amount. Must be rounded to maximum 2 decimals.
     */
    public function withBaseAmount(float|string|null $baseAmount): self
    {
        $obj = clone $this;
        $obj['baseAmount'] = $baseAmount;

        return $obj;
    }

    /**
     * The percentage that may be used, in conjunction with the charge base amount, to calculate the charge amount. To state 20%, use value 20.
     */
    public function withMultiplierFactor(
        float|string|null $multiplierFactor
    ): self {
        $obj = clone $this;
        $obj['multiplierFactor'] = $multiplierFactor;

        return $obj;
    }

    /**
     * The reason for the charge.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

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
        $obj['reasonCode'] = $reasonCode;

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
    public function withTaxCode(TaxCode|string|null $taxCode): self
    {
        $obj = clone $this;
        $obj['taxCode'] = $taxCode;

        return $obj;
    }

    /**
     * The VAT rate, represented as percentage that applies to the charge.
     */
    public function withTaxRate(float|string|null $taxRate): self
    {
        $obj = clone $this;
        $obj['taxRate'] = $taxRate;

        return $obj;
    }
}
