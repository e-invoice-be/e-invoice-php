<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidateJsonParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Charge\TaxCode;

/**
 * A charge is an additional fee for example for late payment, late delivery, etc.
 *
 * @phpstan-type charge_alias = array{
 *   amount?: float|string|null,
 *   baseAmount?: float|string|null,
 *   multiplierFactor?: float|string|null,
 *   reason?: string|null,
 *   reasonCode?: string|null,
 *   taxCode?: value-of<TaxCode>|null,
 *   taxRate?: string|null,
 * }
 */
final class Charge implements BaseModel
{
    /** @use SdkModel<charge_alias> */
    use SdkModel;

    /**
     * The charge amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public float|string|null $amount;

    /**
     * The base amount that may be used, in conjunction with the charge percentage, to calculate the charge amount. Must be rounded to maximum 2 decimals.
     */
    #[Api('base_amount', nullable: true, optional: true)]
    public float|string|null $baseAmount;

    /**
     * The percentage that may be used, in conjunction with the charge base amount, to calculate the charge amount. To state 20%, use value 20.
     */
    #[Api('multiplier_factor', nullable: true, optional: true)]
    public float|string|null $multiplierFactor;

    /**
     * The reason for the charge.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $reason;

    /**
     * The code for the charge reason.
     */
    #[Api('reason_code', nullable: true, optional: true)]
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
    #[Api('tax_code', enum: TaxCode::class, nullable: true, optional: true)]
    public ?string $taxCode;

    /**
     * The VAT rate, represented as percentage that applies to the charge.
     */
    #[Api('tax_rate', nullable: true, optional: true)]
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
     * @param TaxCode|value-of<TaxCode>|null $taxCode
     */
    public static function with(
        float|string|null $amount = null,
        float|string|null $baseAmount = null,
        float|string|null $multiplierFactor = null,
        ?string $reason = null,
        ?string $reasonCode = null,
        TaxCode|string|null $taxCode = null,
        ?string $taxRate = null,
    ): self {
        $obj = new self;

        null !== $amount && $obj->amount = $amount;
        null !== $baseAmount && $obj->baseAmount = $baseAmount;
        null !== $multiplierFactor && $obj->multiplierFactor = $multiplierFactor;
        null !== $reason && $obj->reason = $reason;
        null !== $reasonCode && $obj->reasonCode = $reasonCode;
        null !== $taxCode && $obj['taxCode'] = $taxCode;
        null !== $taxRate && $obj->taxRate = $taxRate;

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
        $obj->baseAmount = $baseAmount;

        return $obj;
    }

    /**
     * The percentage that may be used, in conjunction with the charge base amount, to calculate the charge amount. To state 20%, use value 20.
     */
    public function withMultiplierFactor(
        float|string|null $multiplierFactor
    ): self {
        $obj = clone $this;
        $obj->multiplierFactor = $multiplierFactor;

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
     * The code for the charge reason.
     */
    public function withReasonCode(?string $reasonCode): self
    {
        $obj = clone $this;
        $obj->reasonCode = $reasonCode;

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
    public function withTaxRate(?string $taxRate): self
    {
        $obj = clone $this;
        $obj->taxRate = $taxRate;

        return $obj;
    }
}
