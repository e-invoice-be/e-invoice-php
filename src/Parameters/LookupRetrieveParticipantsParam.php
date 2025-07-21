<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type retrieve_participants_params = array{
 *   query: string, countryCode?: string|null
 * }
 */
final class LookupRetrieveParticipantsParam implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $query;

    #[Api(optional: true)]
    public ?string $countryCode;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $query, ?string $countryCode = null)
    {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->query = $query;

        null !== $countryCode && $this->countryCode = $countryCode;
    }
}
