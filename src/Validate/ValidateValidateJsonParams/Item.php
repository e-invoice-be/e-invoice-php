<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidateJsonParams;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\UnitOfMeasureCode;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Allowance;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Charge;

/**
 * @phpstan-import-type AmountVariants from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Amount
 * @phpstan-import-type QuantityVariants from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Quantity
 * @phpstan-import-type TaxVariants from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Tax
 * @phpstan-import-type TaxRateVariants from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\TaxRate
 * @phpstan-import-type UnitPriceVariants from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\UnitPrice
 * @phpstan-import-type AllowanceShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Allowance
 * @phpstan-import-type AmountShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Amount
 * @phpstan-import-type ChargeShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Charge
 * @phpstan-import-type QuantityShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Quantity
 * @phpstan-import-type TaxShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Tax
 * @phpstan-import-type TaxRateShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\TaxRate
 * @phpstan-import-type UnitPriceShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\UnitPrice
 *
 * @phpstan-type ItemShape = array{
 *   allowances?: list<\EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Allowance|AllowanceShape>|null,
 *   amount?: AmountShape|null,
 *   charges?: list<\EInvoiceAPI\Validate\ValidateValidateJsonParams\Item\Charge|ChargeShape>|null,
 *   date?: null|null,
 *   description?: string|null,
 *   productCode?: string|null,
 *   quantity?: QuantityShape|null,
 *   tax?: TaxShape|null,
 *   taxRate?: TaxRateShape|null,
 *   unit?: null|UnitOfMeasureCode|value-of<UnitOfMeasureCode>,
 *   unitPrice?: UnitPriceShape|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * The allowances of the line item.
     *
     * @var list<Allowance>|null $allowances
     */
    #[Optional(
        list: Allowance::class,
        nullable: true,
    )]
    public ?array $allowances;

    /**
     * The invoice line net amount (BT-131), exclusive of VAT, inclusive of line level allowances and charges. Calculated as: ((unit_price / price_base_quantity) * quantity) - allowances + charges. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     *
     * @var AmountVariants|null $amount
     */
    #[Optional(nullable: true)]
    public float|string|null $amount;

    /**
     * The charges of the line item.
     *
     * @var list<Charge>|null $charges
     */
    #[Optional(
        list: Charge::class,
        nullable: true,
    )]
    public ?array $charges;

    /** @var null|null $date */
    #[Optional(nullable: true)]
    public null $date;

    /**
     * The description of the line item.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * The product code of the line item.
     */
    #[Optional('product_code', nullable: true)]
    public ?string $productCode;

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals. Can be negative for credit notes or corrections.
     *
     * @var QuantityVariants|null $quantity
     */
    #[Optional(nullable: true)]
    public float|string|null $quantity;

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     *
     * @var TaxVariants|null $tax
     */
    #[Optional(nullable: true)]
    public float|string|null $tax;

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     *
     * @var TaxRateVariants|null $taxRate
     */
    #[Optional('tax_rate', nullable: true)]
    public float|string|null $taxRate;

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @var value-of<UnitOfMeasureCode>|null $unit
     */
    #[Optional(enum: UnitOfMeasureCode::class, nullable: true)]
    public ?string $unit;

    /**
     * The item net price (BT-146). The price of an item, exclusive of VAT, after subtracting item price discount. Must be rounded to maximum 4 decimals.
     *
     * @var UnitPriceVariants|null $unitPrice
     */
    #[Optional('unit_price', nullable: true)]
    public float|string|null $unitPrice;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Allowance|AllowanceShape>|null $allowances
     * @param AmountShape|null $amount
     * @param list<Charge|ChargeShape>|null $charges
     * @param QuantityShape|null $quantity
     * @param TaxShape|null $tax
     * @param TaxRateShape|null $taxRate
     * @param UnitOfMeasureCode|value-of<UnitOfMeasureCode>|null $unit
     * @param UnitPriceShape|null $unitPrice
     */
    public static function with(
        ?array $allowances = null,
        float|string|null $amount = null,
        ?array $charges = null,
        null $date = null,
        ?string $description = null,
        ?string $productCode = null,
        float|string|null $quantity = null,
        float|string|null $tax = null,
        float|string|null $taxRate = null,
        UnitOfMeasureCode|string|null $unit = null,
        float|string|null $unitPrice = null,
    ): self {
        $self = new self;

        $self['date'] = $date;

        null !== $allowances && $self['allowances'] = $allowances;
        null !== $amount && $self['amount'] = $amount;
        null !== $charges && $self['charges'] = $charges;
        null !== $description && $self['description'] = $description;
        null !== $productCode && $self['productCode'] = $productCode;
        null !== $quantity && $self['quantity'] = $quantity;
        null !== $tax && $self['tax'] = $tax;
        null !== $taxRate && $self['taxRate'] = $taxRate;
        null !== $unit && $self['unit'] = $unit;
        null !== $unitPrice && $self['unitPrice'] = $unitPrice;

        return $self;
    }

    /**
     * The allowances of the line item.
     *
     * @param list<Allowance|AllowanceShape>|null $allowances
     */
    public function withAllowances(?array $allowances): self
    {
        $self = clone $this;
        $self['allowances'] = $allowances;

        return $self;
    }

    /**
     * The invoice line net amount (BT-131), exclusive of VAT, inclusive of line level allowances and charges. Calculated as: ((unit_price / price_base_quantity) * quantity) - allowances + charges. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     *
     * @param AmountShape|null $amount
     */
    public function withAmount(float|string|null $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The charges of the line item.
     *
     * @param list<Charge|ChargeShape>|null $charges
     */
    public function withCharges(?array $charges): self
    {
        $self = clone $this;
        $self['charges'] = $charges;

        return $self;
    }

    /**
     * @param null|null $date
     */
    public function withDate(null $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * The description of the line item.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The product code of the line item.
     */
    public function withProductCode(?string $productCode): self
    {
        $self = clone $this;
        $self['productCode'] = $productCode;

        return $self;
    }

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals. Can be negative for credit notes or corrections.
     *
     * @param QuantityShape|null $quantity
     */
    public function withQuantity(float|string|null $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     *
     * @param TaxShape|null $tax
     */
    public function withTax(float|string|null $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     *
     * @param TaxRateShape|null $taxRate
     */
    public function withTaxRate(float|string|null $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @param UnitOfMeasureCode|value-of<UnitOfMeasureCode>|null $unit
     */
    public function withUnit(UnitOfMeasureCode|string|null $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }

    /**
     * The item net price (BT-146). The price of an item, exclusive of VAT, after subtracting item price discount. Must be rounded to maximum 4 decimals.
     *
     * @param UnitPriceShape|null $unitPrice
     */
    public function withUnitPrice(float|string|null $unitPrice): self
    {
        $self = clone $this;
        $self['unitPrice'] = $unitPrice;

        return $self;
    }
}
