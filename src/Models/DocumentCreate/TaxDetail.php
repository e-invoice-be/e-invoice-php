<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentCreate;

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

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        null|float|string $amount = null,
        ?string $rate = null
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        null !== $amount && $this->amount = $amount;
        null !== $rate && $this->rate = $rate;
    }
}
