<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
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
    use SdkModel;
    use SdkParams;

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
     * `new LookupRetrieveParticipantsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LookupRetrieveParticipantsParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LookupRetrieveParticipantsParams)->withQuery(...)
     * ```
     */
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
    public static function with(
        string $query,
        ?string $countryCode = null
    ): self {
        $obj = new self;

        $obj->query = $query;

        null !== $countryCode && $obj->countryCode = $countryCode;

        return $obj;
    }

    /**
     * Query to lookup.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj->query = $query;

        return $obj;
    }

    /**
     * Country code of the company to lookup. If not provided, the search will be global.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $obj = clone $this;
        $obj->countryCode = $countryCode;

        return $obj;
    }
}
