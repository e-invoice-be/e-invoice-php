<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class Item implements BaseModel
{
    use Model;

    #[Api(optional: true)]
    public ?string $amount;

    #[Api(optional: true)]
    public ?null $date;

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

    #[Api(optional: true)]
    public ?string $unit;

    #[Api('unit_price', optional: true)]
    public ?string $unitPrice;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        ?string $amount = null,
        ?null $date = null,
        ?string $description = null,
        ?string $productCode = null,
        ?string $quantity = null,
        ?string $tax = null,
        ?string $taxRate = null,
        ?string $unit = null,
        ?string $unitPrice = null,
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

Item::_loadMetadata();
