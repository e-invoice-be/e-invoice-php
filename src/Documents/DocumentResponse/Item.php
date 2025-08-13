<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\UnitOfMeasureCode;

/**
 * @phpstan-type item_alias = array{
 *   amount?: string|null,
 *   date?: null|null,
 *   description?: string|null,
 *   productCode?: string|null,
 *   quantity?: string|null,
 *   tax?: string|null,
 *   taxRate?: string|null,
 *   unit?: UnitOfMeasureCode::*,
 *   unitPrice?: string|null,
 * }
 */
final class Item implements BaseModel
{
    use Model;

    #[Api(optional: true)]
    public ?string $amount;

    /** @var null|null $date */
    #[Api(optional: true)]
    public null $date;

    #[Api(optional: true)]
    public ?string $description;

    #[Api('product_code', optional: true)]
    public ?string $productCode;

    #[Api(optional: true)]
    public ?string $quantity;

    #[Api(optional: true)]
    public ?string $tax;

    #[Api('tax_rate', optional: true)]
    public ?string $taxRate;

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @var null|UnitOfMeasureCode::* $unit
     */
    #[Api(enum: UnitOfMeasureCode::class, optional: true)]
    public ?string $unit;

    #[Api('unit_price', optional: true)]
    public ?string $unitPrice;

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
    public static function from(
        ?string $amount = null,
        null $date = null,
        ?string $description = null,
        ?string $productCode = null,
        ?string $quantity = null,
        ?string $tax = null,
        ?string $taxRate = null,
        ?string $unit = null,
        ?string $unitPrice = null,
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

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param null|null $date
     */
    public function setDate(null $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setProductCode(?string $productCode): self
    {
        $this->productCode = $productCode;

        return $this;
    }

    public function setQuantity(?string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setTax(?string $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function setTaxRate(?string $taxRate): self
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @param UnitOfMeasureCode::* $unit
     */
    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function setUnitPrice(?string $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }
}
