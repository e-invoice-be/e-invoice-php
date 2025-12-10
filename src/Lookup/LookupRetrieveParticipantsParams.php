<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Lookup Peppol participants by name or other identifiers. You can limit the search to a specific country by providing the country code.
 *
 * @see EInvoiceAPI\Services\LookupService::retrieveParticipants()
 *
 * @phpstan-type LookupRetrieveParticipantsParamsShape = array{
 *   query: string, countryCode?: string|null
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
    #[Required]
    public string $query;

    /**
     * Country code of the company to lookup. If not provided, the search will be global.
     */
    #[Optional(nullable: true)]
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
        $self = new self;

        $self['query'] = $query;

        null !== $countryCode && $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Query to lookup.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Country code of the company to lookup. If not provided, the search will be global.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }
}
