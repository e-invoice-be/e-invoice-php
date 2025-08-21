<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\UnitOfMeasureCode;

/**
 * @phpstan-type item_alias = array{
 *   amount?: float|string|null,
 *   date?: null|null,
 *   description?: string|null,
 *   productCode?: string|null,
 *   quantity?: float|string|null,
 *   tax?: float|string|null,
 *   taxRate?: string|null,
 *   unit?: UnitOfMeasureCode::*,
 *   unitPrice?: float|string|null,
 * }
 */
final class Item implements BaseModel
{
    use SdkModel;

    #[Api(optional: true)]
    public float|string|null $amount;

    /** @var null|null $date */
    #[Api(optional: true)]
    public null $date;

    #[Api(optional: true)]
    public ?string $description;

    #[Api('product_code', optional: true)]
    public ?string $productCode;

    #[Api(optional: true)]
    public float|string|null $quantity;

    #[Api(optional: true)]
    public float|string|null $tax;

    #[Api('tax_rate', optional: true)]
    public ?string $taxRate;

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @var UnitOfMeasureCode::*|null $unit
     */
    #[Api(enum: UnitOfMeasureCode::class, optional: true)]
    public ?string $unit;

    #[Api('unit_price', optional: true)]
    public float|string|null $unitPrice;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param UnitOfMeasureCode::* $unit
     */
    public static function with(
        float|string|null $amount = null,
        null $date = null,
        ?string $description = null,
        ?string $productCode = null,
        float|string|null $quantity = null,
        float|string|null $tax = null,
        ?string $taxRate = null,
        ?string $unit = null,
        float|string|null $unitPrice = null,
    ): self {
        $obj = new self;

        null !== $amount && $obj->amount = $amount;
        null !== $date && $obj->date = $date;
        null !== $description && $obj->description = $description;
        null !== $productCode && $obj->productCode = $productCode;
        null !== $quantity && $obj->quantity = $quantity;
        null !== $tax && $obj->tax = $tax;
        null !== $taxRate && $obj->taxRate = $taxRate;
        null !== $unit && $obj->unit = $unit;
        null !== $unitPrice && $obj->unitPrice = $unitPrice;

        return $obj;
    }

    public function withAmount(float|string|null $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

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

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    public function withProductCode(?string $productCode): self
    {
        $obj = clone $this;
        $obj->productCode = $productCode;

        return $obj;
    }

    public function withQuantity(float|string|null $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }

    public function withTax(float|string|null $tax): self
    {
        $obj = clone $this;
        $obj->tax = $tax;

        return $obj;
    }

    public function withTaxRate(?string $taxRate): self
    {
        $obj = clone $this;
        $obj->taxRate = $taxRate;

        return $obj;
    }

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @param UnitOfMeasureCode::* $unit
     */
    public function withUnit(string $unit): self
    {
        $obj = clone $this;
        $obj->unit = $unit;

        return $obj;
    }

    public function withUnitPrice(float|string|null $unitPrice): self
    {
        $obj = clone $this;
        $obj->unitPrice = $unitPrice;

        return $obj;
    }
}
