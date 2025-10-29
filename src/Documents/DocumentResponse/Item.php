<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Allowance;
use EInvoiceAPI\Documents\Charge;
use EInvoiceAPI\Documents\UnitOfMeasureCode;

/**
 * @phpstan-type item_alias = array{
 *   allowances?: list<Allowance>|null,
 *   amount?: string|null,
 *   charges?: list<Charge>|null,
 *   date?: null|null,
 *   description?: string|null,
 *   productCode?: string|null,
 *   quantity?: string|null,
 *   tax?: string|null,
 *   taxRate?: string|null,
 *   unit?: value-of<UnitOfMeasureCode>|null,
 *   unitPrice?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<item_alias> */
    use SdkModel;

    /**
     * The allowances of the line item.
     *
     * @var list<Allowance>|null $allowances
     */
    #[Api(list: Allowance::class, nullable: true, optional: true)]
    public ?array $allowances;

    /**
     * The total amount of the line item, exclusive of VAT, after subtracting line level allowances and adding line level charges. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $amount;

    /**
     * The charges of the line item.
     *
     * @var list<Charge>|null $charges
     */
    #[Api(list: Charge::class, nullable: true, optional: true)]
    public ?array $charges;

    /** @var null|null $date */
    #[Api(nullable: true, optional: true)]
    public null $date;

    /**
     * The description of the line item.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * The product code of the line item.
     */
    #[Api('product_code', nullable: true, optional: true)]
    public ?string $productCode;

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $quantity;

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tax;

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     */
    #[Api('tax_rate', nullable: true, optional: true)]
    public ?string $taxRate;

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @var value-of<UnitOfMeasureCode>|null $unit
     */
    #[Api(enum: UnitOfMeasureCode::class, nullable: true, optional: true)]
    public ?string $unit;

    /**
     * The unit price of the line item. Must be rounded to maximum 2 decimals.
     */
    #[Api('unit_price', nullable: true, optional: true)]
    public ?string $unitPrice;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Allowance>|null $allowances
     * @param list<Charge>|null $charges
     * @param UnitOfMeasureCode|value-of<UnitOfMeasureCode>|null $unit
     */
    public static function with(
        ?array $allowances = null,
        ?string $amount = null,
        ?array $charges = null,
        null $date = null,
        ?string $description = null,
        ?string $productCode = null,
        ?string $quantity = null,
        ?string $tax = null,
        ?string $taxRate = null,
        UnitOfMeasureCode|string|null $unit = null,
        ?string $unitPrice = null,
    ): self {
        $obj = new self;

        null !== $allowances && $obj->allowances = $allowances;
        null !== $amount && $obj->amount = $amount;
        null !== $charges && $obj->charges = $charges;
        null !== $date && $obj->date = $date;
        null !== $description && $obj->description = $description;
        null !== $productCode && $obj->productCode = $productCode;
        null !== $quantity && $obj->quantity = $quantity;
        null !== $tax && $obj->tax = $tax;
        null !== $taxRate && $obj->taxRate = $taxRate;
        null !== $unit && $obj['unit'] = $unit;
        null !== $unitPrice && $obj->unitPrice = $unitPrice;

        return $obj;
    }

    /**
     * The allowances of the line item.
     *
     * @param list<Allowance>|null $allowances
     */
    public function withAllowances(?array $allowances): self
    {
        $obj = clone $this;
        $obj->allowances = $allowances;

        return $obj;
    }

    /**
     * The total amount of the line item, exclusive of VAT, after subtracting line level allowances and adding line level charges. Must be rounded to maximum 2 decimals.
     */
    public function withAmount(?string $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * The charges of the line item.
     *
     * @param list<Charge>|null $charges
     */
    public function withCharges(?array $charges): self
    {
        $obj = clone $this;
        $obj->charges = $charges;

        return $obj;
    }

    /**
     * @param null|null $date
     */
    public function withDate(null $date): self
    {
        $obj = clone $this;
        $obj->date = $date;

        return $obj;
    }

    /**
     * The description of the line item.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * The product code of the line item.
     */
    public function withProductCode(?string $productCode): self
    {
        $obj = clone $this;
        $obj->productCode = $productCode;

        return $obj;
    }

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals.
     */
    public function withQuantity(?string $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals.
     */
    public function withTax(?string $tax): self
    {
        $obj = clone $this;
        $obj->tax = $tax;

        return $obj;
    }

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     */
    public function withTaxRate(?string $taxRate): self
    {
        $obj = clone $this;
        $obj->taxRate = $taxRate;

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
     * The unit price of the line item. Must be rounded to maximum 2 decimals.
     */
    public function withUnitPrice(?string $unitPrice): self
    {
        $obj = clone $this;
        $obj->unitPrice = $unitPrice;

        return $obj;
    }
}
