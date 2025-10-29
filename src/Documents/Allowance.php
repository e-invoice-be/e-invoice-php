<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Allowance\TaxCode;

/**
 * An allowance is a discount for example for early payment, volume discount, etc.
 *
 * @phpstan-type allowance_alias = array{
 *   amount?: string|null,
 *   baseAmount?: string|null,
 *   multiplierFactor?: string|null,
 *   reason?: string|null,
 *   reasonCode?: string|null,
 *   taxCode?: value-of<TaxCode>|null,
 *   taxRate?: string|null,
 * }
 */
final class Allowance implements BaseModel
{
    /** @use SdkModel<allowance_alias> */
    use SdkModel;

    /**
     * The allowance amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $amount;

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    #[Api('base_amount', nullable: true, optional: true)]
    public ?string $baseAmount;

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20.
     */
    #[Api('multiplier_factor', nullable: true, optional: true)]
    public ?string $multiplierFactor;

    /**
     * The reason for the allowance.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $reason;

    /**
     * The code for the allowance reason.
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
     * The VAT rate, represented as percentage that applies to the allowance.
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
        ?string $amount = null,
        ?string $baseAmount = null,
        ?string $multiplierFactor = null,
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
     * The allowance amount, without VAT. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(?string $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * The base amount that may be used, in conjunction with the allowance percentage, to calculate the allowance amount. Must be rounded to maximum 2 decimals.
     */
    public function withBaseAmount(?string $baseAmount): self
    {
        $obj = clone $this;
        $obj->baseAmount = $baseAmount;

        return $obj;
    }

    /**
     * The percentage that may be used, in conjunction with the allowance base amount, to calculate the allowance amount. To state 20%, use value 20.
     */
    public function withMultiplierFactor(?string $multiplierFactor): self
    {
        $obj = clone $this;
        $obj->multiplierFactor = $multiplierFactor;

        return $obj;
    }

    /**
     * The reason for the allowance.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }

    /**
     * The code for the allowance reason.
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
     * The VAT rate, represented as percentage that applies to the allowance.
     */
    public function withTaxRate(?string $taxRate): self
    {
        $obj = clone $this;
        $obj->taxRate = $taxRate;

        return $obj;
    }
}
