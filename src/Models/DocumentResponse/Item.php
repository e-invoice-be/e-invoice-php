<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\UnitOfMeasureCode;

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

    /** @var null|UnitOfMeasureCode::* $unit */
    #[Api(optional: true)]
    public ?string $unit;

    #[Api('unit_price', optional: true)]
    public ?string $unitPrice;

    /**
     * You must use named parameters to construct this object.
     *
     * @param UnitOfMeasureCode::* $unit
     */
    final public function __construct(
        ?string $amount = null,
        null $date = null,
        ?string $description = null,
        ?string $productCode = null,
        ?string $quantity = null,
        ?string $tax = null,
        ?string $taxRate = null,
        ?string $unit = null,
        ?string $unitPrice = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        null !== $amount && $this->amount = $amount;
        null !== $date && $this->date = $date;
        null !== $description && $this->description = $description;
        null !== $productCode && $this->productCode = $productCode;
        null !== $quantity && $this->quantity = $quantity;
        null !== $tax && $this->tax = $tax;
        null !== $taxRate && $this->taxRate = $taxRate;
        null !== $unit && $this->unit = $unit;
        null !== $unitPrice && $this->unitPrice = $unitPrice;
    }
}
