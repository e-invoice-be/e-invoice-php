<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity\Identifier;

/**
 * Represents a business entity.
 *
 * @phpstan-type EntityShape = array{
 *   additional_info?: string|null,
 *   country_code?: string|null,
 *   geo_info?: string|null,
 *   identifiers?: list<Identifier>|null,
 *   name?: string|null,
 *   registration_date?: string|null,
 *   website?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    /**
     * Additional information.
     */
    #[Optional(nullable: true)]
    public ?string $additional_info;

    /**
     * Country code.
     */
    #[Optional(nullable: true)]
    public ?string $country_code;

    /**
     * Geographic information.
     */
    #[Optional(nullable: true)]
    public ?string $geo_info;

    /**
     * List of business identifiers.
     *
     * @var list<Identifier>|null $identifiers
     */
    #[Optional(list: Identifier::class)]
    public ?array $identifiers;

    /**
     * Business entity name.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Registration date.
     */
    #[Optional(nullable: true)]
    public ?string $registration_date;

    /**
     * Website URL.
     */
    #[Optional(nullable: true)]
    public ?string $website;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Identifier|array{scheme: string, value: string}> $identifiers
     */
    public static function with(
        ?string $additional_info = null,
        ?string $country_code = null,
        ?string $geo_info = null,
        ?array $identifiers = null,
        ?string $name = null,
        ?string $registration_date = null,
        ?string $website = null,
    ): self {
        $obj = new self;

        null !== $additional_info && $obj['additional_info'] = $additional_info;
        null !== $country_code && $obj['country_code'] = $country_code;
        null !== $geo_info && $obj['geo_info'] = $geo_info;
        null !== $identifiers && $obj['identifiers'] = $identifiers;
        null !== $name && $obj['name'] = $name;
        null !== $registration_date && $obj['registration_date'] = $registration_date;
        null !== $website && $obj['website'] = $website;

        return $obj;
    }

    /**
     * Additional information.
     */
    public function withAdditionalInfo(?string $additionalInfo): self
    {
        $obj = clone $this;
        $obj['additional_info'] = $additionalInfo;

        return $obj;
    }

    /**
     * Country code.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $obj = clone $this;
        $obj['country_code'] = $countryCode;

        return $obj;
    }

    /**
     * Geographic information.
     */
    public function withGeoInfo(?string $geoInfo): self
    {
        $obj = clone $this;
        $obj['geo_info'] = $geoInfo;

        return $obj;
    }

    /**
     * List of business identifiers.
     *
     * @param list<Identifier|array{scheme: string, value: string}> $identifiers
     */
    public function withIdentifiers(array $identifiers): self
    {
        $obj = clone $this;
        $obj['identifiers'] = $identifiers;

        return $obj;
    }

    /**
     * Business entity name.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Registration date.
     */
    public function withRegistrationDate(?string $registrationDate): self
    {
        $obj = clone $this;
        $obj['registration_date'] = $registrationDate;

        return $obj;
    }

    /**
     * Website URL.
     */
    public function withWebsite(?string $website): self
    {
        $obj = clone $this;
        $obj['website'] = $website;

        return $obj;
    }
}
