<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Lookup Peppol participants by name or other identifiers. You can limit the search to a specific country by providing the country code.
 *
 * @phpstan-type retrieve_participants_params = array{
 *   query: string, countryCode?: string|null
 * }
 */
final class LookupRetrieveParticipantsParam implements BaseModel
{
    use Model;
    use Params;

    /**
     * Query to lookup.
     */
    #[Api]
    public string $query;

    /**
     * Country code of the company to lookup. If not provided, the search will be global.
     */
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
