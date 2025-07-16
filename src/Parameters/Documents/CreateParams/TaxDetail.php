<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\CreateParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

final class TaxDetail implements BaseModel
{
    use Model;

    #[Api(optional: true)]
    public null|float|string $amount;

    #[Api(optional: true)]
    public ?string $rate;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|float|string $amount
     * @param null|string       $rate
     */
    final public function __construct(
        $amount = None::NOT_GIVEN,
        $rate = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

TaxDetail::_loadMetadata();
