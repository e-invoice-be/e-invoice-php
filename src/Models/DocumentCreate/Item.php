<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentCreate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

class Item implements BaseModel
{
    use Model;

    /** @var null|float|string $amount */
    #[Api(optional: true)]
    public mixed $amount;

    #[Api(optional: true)]
    public ?null $date;

    #[Api(optional: true)]
    public ?string $description;

    #[Api('product_code', optional: true)]
    public ?string $productCode;

    /** @var null|float|string $quantity */
    #[Api(optional: true)]
    public mixed $quantity;

    /** @var null|float|string $tax */
    #[Api(optional: true)]
    public mixed $tax;

    #[Api('tax_rate', optional: true)]
    public ?string $taxRate;

    #[Api(optional: true)]
    public ?string $unit;

    /** @var null|float|string $unitPrice */
    #[Api('unit_price', optional: true)]
    public mixed $unitPrice;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|float|string $amount
     * @param null|null         $date
     * @param null|string       $description
     * @param null|string       $productCode
     * @param null|float|string $quantity
     * @param null|float|string $tax
     * @param null|string       $taxRate
     * @param string            $unit
     * @param null|float|string $unitPrice
     */
    final public function __construct(
        $amount = None::NOT_GIVEN,
        $date = None::NOT_GIVEN,
        $description = None::NOT_GIVEN,
        $productCode = None::NOT_GIVEN,
        $quantity = None::NOT_GIVEN,
        $tax = None::NOT_GIVEN,
        $taxRate = None::NOT_GIVEN,
        $unit = None::NOT_GIVEN,
        $unitPrice = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Item::_loadMetadata();
