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
final class LookupRetrieveParticipantsParams implements BaseModel
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
    public static function new(string $query, ?string $countryCode = null): self
    {
        $obj = new self;

        $obj->query = $query;

        null !== $countryCode && $obj->countryCode = $countryCode;

        return $obj;
    }
}
