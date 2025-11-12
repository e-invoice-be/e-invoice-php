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
 * @see EInvoiceAPI\Lookup->retrieveParticipants
 *
 * @phpstan-type LookupRetrieveParticipantsParamsShape = array{
 *   query: string, country_code?: string|null
 * }
 */
final class LookupRetrieveParticipantsParams implements BaseModel
{
    /** @use SdkModel<LookupRetrieveParticipantsParamsShape> */
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
    public ?string $country_code;

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
        ?string $country_code = null
    ): self {
        $obj = new self;

        $obj->query = $query;

        null !== $country_code && $obj->country_code = $country_code;

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
        $obj->country_code = $countryCode;

        return $obj;
    }
}
