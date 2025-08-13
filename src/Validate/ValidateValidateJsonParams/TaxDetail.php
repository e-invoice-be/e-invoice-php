<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidateJsonParams;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type tax_detail_alias = array{
 *   amount?: float|string|null, rate?: string|null
 * }
 */
final class TaxDetail implements BaseModel
{
    use Model;

    #[Api(optional: true)]
    public null|float|string $amount;

    #[Api(optional: true)]
    public ?string $rate;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
        null|float|string $amount = null,
        ?string $rate = null
    ): self {
        $obj = new self;

        null !== $amount && $obj->amount = $amount;
        null !== $rate && $obj->rate = $rate;

        return $obj;
    }

    public function setAmount(null|float|string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setRate(?string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
