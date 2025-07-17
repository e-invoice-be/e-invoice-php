<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Validate\ValidateJsonParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\UnitOfMeasureCode;

final class Item implements BaseModel
{
    use Model;

    #[Api(optional: true)]
    public null|float|string $amount;

    #[Api(optional: true)]
    public ?null $date;

    #[Api(optional: true)]
    public ?string $description;

    #[Api('product_code', optional: true)]
    public ?string $productCode;

    #[Api(optional: true)]
    public null|float|string $quantity;

    #[Api(optional: true)]
    public null|float|string $tax;

    #[Api('tax_rate', optional: true)]
    public ?string $taxRate;

    /** @var null|UnitOfMeasureCode::* $unit */
    #[Api(optional: true)]
    public ?string $unit;

    #[Api('unit_price', optional: true)]
    public null|float|string $unitPrice;

    /**
     * You must use named parameters to construct this object.
     *
     * @param UnitOfMeasureCode::* $unit
     */
    final public function __construct(
        null|float|string $amount = null,
        ?null $date = null,
        ?string $description = null,
        ?string $productCode = null,
        null|float|string $quantity = null,
        null|float|string $tax = null,
        ?string $taxRate = null,
        ?string $unit = null,
        null|float|string $unitPrice = null,
    ) {
        $this->amount = $amount;
        $this->date = $date;
        $this->description = $description;
        $this->productCode = $productCode;
        $this->quantity = $quantity;
        $this->tax = $tax;
        $this->taxRate = $taxRate;
        $this->unit = $unit;
        $this->unitPrice = $unitPrice;
    }
}

Item::__introspect();
