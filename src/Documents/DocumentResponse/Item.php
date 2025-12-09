<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Allowance;
use EInvoiceAPI\Documents\Allowance\ReasonCode;
use EInvoiceAPI\Documents\Allowance\TaxCode;
use EInvoiceAPI\Documents\Charge;
use EInvoiceAPI\Documents\UnitOfMeasureCode;

/**
 * @phpstan-type ItemShape = array{
 *   allowances?: list<\EInvoiceAPI\Documents\Allowance>|null,
 *   amount?: string|null,
 *   charges?: list<\EInvoiceAPI\Documents\Charge>|null,
 *   date?: null|null,
 *   description?: string|null,
 *   product_code?: string|null,
 *   quantity?: string|null,
 *   tax?: string|null,
 *   tax_rate?: string|null,
 *   unit?: value-of<UnitOfMeasureCode>|null,
 *   unit_price?: string|null,
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
    #[Optional(list: Allowance::class, nullable: true)]
    public ?array $allowances;

    /**
     * The invoice line net amount (BT-131), exclusive of VAT, inclusive of line level allowances and charges. Calculated as: ((unit_price / price_base_quantity) * quantity) - allowances + charges. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    #[Optional(nullable: true)]
    public ?string $amount;

    /**
     * The charges of the line item.
     *
     * @var list<Charge>|null $charges
     */
    #[Optional(list: Charge::class, nullable: true)]
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
    #[Optional(nullable: true)]
    public ?string $product_code;

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals. Can be negative for credit notes or corrections.
     */
    #[Optional(nullable: true)]
    public ?string $quantity;

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    #[Optional(nullable: true)]
    public ?string $tax;

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $tax_rate;

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @var value-of<UnitOfMeasureCode>|null $unit
     */
    #[Optional(enum: UnitOfMeasureCode::class, nullable: true)]
    public ?string $unit;

    /**
     * The item net price (BT-146). The price of an item, exclusive of VAT, after subtracting item price discount. Must be rounded to maximum 4 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $unit_price;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Allowance|array{
     *   amount?: string|null,
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<ReasonCode>|null,
     *   tax_code?: value-of<TaxCode>|null,
     *   tax_rate?: string|null,
     * }>|null $allowances
     * @param list<Charge|array{
     *   amount?: string|null,
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<Charge\ReasonCode>|null,
     *   tax_code?: value-of<Charge\TaxCode>|null,
     *   tax_rate?: string|null,
     * }>|null $charges
     * @param UnitOfMeasureCode|value-of<UnitOfMeasureCode>|null $unit
     */
    public static function with(
        ?array $allowances = null,
        ?string $amount = null,
        ?array $charges = null,
        null $date = null,
        ?string $description = null,
        ?string $product_code = null,
        ?string $quantity = null,
        ?string $tax = null,
        ?string $tax_rate = null,
        UnitOfMeasureCode|string|null $unit = null,
        ?string $unit_price = null,
    ): self {
        $obj = new self;

        $obj['date'] = $date;

        null !== $allowances && $obj['allowances'] = $allowances;
        null !== $amount && $obj['amount'] = $amount;
        null !== $charges && $obj['charges'] = $charges;
        null !== $description && $obj['description'] = $description;
        null !== $product_code && $obj['product_code'] = $product_code;
        null !== $quantity && $obj['quantity'] = $quantity;
        null !== $tax && $obj['tax'] = $tax;
        null !== $tax_rate && $obj['tax_rate'] = $tax_rate;
        null !== $unit && $obj['unit'] = $unit;
        null !== $unit_price && $obj['unit_price'] = $unit_price;

        return $obj;
    }

    /**
     * The allowances of the line item.
     *
     * @param list<Allowance|array{
     *   amount?: string|null,
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<ReasonCode>|null,
     *   tax_code?: value-of<TaxCode>|null,
     *   tax_rate?: string|null,
     * }>|null $allowances
     */
    public function withAllowances(?array $allowances): self
    {
        $obj = clone $this;
        $obj['allowances'] = $allowances;

        return $obj;
    }

    /**
     * The invoice line net amount (BT-131), exclusive of VAT, inclusive of line level allowances and charges. Calculated as: ((unit_price / price_base_quantity) * quantity) - allowances + charges. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    public function withAmount(?string $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The charges of the line item.
     *
     * @param list<Charge|array{
     *   amount?: string|null,
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<Charge\ReasonCode>|null,
     *   tax_code?: value-of<Charge\TaxCode>|null,
     *   tax_rate?: string|null,
     * }>|null $charges
     */
    public function withCharges(?array $charges): self
    {
        $obj = clone $this;
        $obj['charges'] = $charges;

        return $obj;
    }

    /**
     * @param null|null $date
     */
    public function withDate(null $date): self
    {
        $obj = clone $this;
        $obj['date'] = $date;

        return $obj;
    }

    /**
     * The description of the line item.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * The product code of the line item.
     */
    public function withProductCode(?string $productCode): self
    {
        $obj = clone $this;
        $obj['product_code'] = $productCode;

        return $obj;
    }

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals. Can be negative for credit notes or corrections.
     */
    public function withQuantity(?string $quantity): self
    {
        $obj = clone $this;
        $obj['quantity'] = $quantity;

        return $obj;
    }

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    public function withTax(?string $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     */
    public function withTaxRate(?string $taxRate): self
    {
        $obj = clone $this;
        $obj['tax_rate'] = $taxRate;

        return $obj;
    }

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @param UnitOfMeasureCode|value-of<UnitOfMeasureCode>|null $unit
     */
    public function withUnit(UnitOfMeasureCode|string|null $unit): self
    {
        $obj = clone $this;
        $obj['unit'] = $unit;

        return $obj;
    }

    /**
     * The item net price (BT-146). The price of an item, exclusive of VAT, after subtracting item price discount. Must be rounded to maximum 4 decimals.
     */
    public function withUnitPrice(?string $unitPrice): self
    {
        $obj = clone $this;
        $obj['unit_price'] = $unitPrice;

        return $obj;
    }
}
