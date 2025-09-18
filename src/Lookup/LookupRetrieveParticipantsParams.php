<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new LookupRetrieveParticipantsParams); // set properties as needed
 * $client->lookup->retrieveParticipants(...$params->toArray());
 * ```
 * Lookup Peppol participants by name or other identifiers. You can limit the search to a specific country by providing the country code.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->lookup->retrieveParticipants(...$params->toArray());`
 *
 * @see EInvoiceAPI\Lookup->retrieveParticipants
 *
 * @phpstan-type lookup_retrieve_participants_params = array{
 *   query: string, countryCode?: string|null
 * }
 */
final class LookupRetrieveParticipantsParams implements BaseModel
{
    /** @use SdkModel<lookup_retrieve_participants_params> */
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
    #[Api(nullable: true, optional: true)]
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
        $this->initialize();
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
