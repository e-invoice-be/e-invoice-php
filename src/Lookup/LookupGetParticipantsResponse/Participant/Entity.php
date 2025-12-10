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
 *   additionalInfo?: string|null,
 *   countryCode?: string|null,
 *   geoInfo?: string|null,
 *   identifiers?: list<Identifier>|null,
 *   name?: string|null,
 *   registrationDate?: string|null,
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
    #[Optional('additional_info', nullable: true)]
    public ?string $additionalInfo;

    /**
     * Country code.
     */
    #[Optional('country_code', nullable: true)]
    public ?string $countryCode;

    /**
     * Geographic information.
     */
    #[Optional('geo_info', nullable: true)]
    public ?string $geoInfo;

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
    #[Optional('registration_date', nullable: true)]
    public ?string $registrationDate;

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
        ?string $additionalInfo = null,
        ?string $countryCode = null,
        ?string $geoInfo = null,
        ?array $identifiers = null,
        ?string $name = null,
        ?string $registrationDate = null,
        ?string $website = null,
    ): self {
        $self = new self;

        null !== $additionalInfo && $self['additionalInfo'] = $additionalInfo;
        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $geoInfo && $self['geoInfo'] = $geoInfo;
        null !== $identifiers && $self['identifiers'] = $identifiers;
        null !== $name && $self['name'] = $name;
        null !== $registrationDate && $self['registrationDate'] = $registrationDate;
        null !== $website && $self['website'] = $website;

        return $self;
    }

    /**
     * Additional information.
     */
    public function withAdditionalInfo(?string $additionalInfo): self
    {
        $self = clone $this;
        $self['additionalInfo'] = $additionalInfo;

        return $self;
    }

    /**
     * Country code.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Geographic information.
     */
    public function withGeoInfo(?string $geoInfo): self
    {
        $self = clone $this;
        $self['geoInfo'] = $geoInfo;

        return $self;
    }

    /**
     * List of business identifiers.
     *
     * @param list<Identifier|array{scheme: string, value: string}> $identifiers
     */
    public function withIdentifiers(array $identifiers): self
    {
        $self = clone $this;
        $self['identifiers'] = $identifiers;

        return $self;
    }

    /**
     * Business entity name.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Registration date.
     */
    public function withRegistrationDate(?string $registrationDate): self
    {
        $self = clone $this;
        $self['registrationDate'] = $registrationDate;

        return $self;
    }

    /**
     * Website URL.
     */
    public function withWebsite(?string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }
}
