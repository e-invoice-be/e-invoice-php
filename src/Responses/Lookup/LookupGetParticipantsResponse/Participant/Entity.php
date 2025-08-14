<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse\Participant\Entity\Identifier;

/**
 * Represents a business entity.
 *
 * @phpstan-type entity_alias = array{
 *   additionalInfo?: string|null,
 *   countryCode?: string|null,
 *   geoInfo?: string|null,
 *   identifiers?: list<Identifier>,
 *   name?: string|null,
 *   registrationDate?: string|null,
 *   website?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    use Model;

    /**
     * Additional information.
     */
    #[Api('additional_info', optional: true)]
    public ?string $additionalInfo;

    /**
     * Country code.
     */
    #[Api('country_code', optional: true)]
    public ?string $countryCode;

    /**
     * Geographic information.
     */
    #[Api('geo_info', optional: true)]
    public ?string $geoInfo;

    /**
     * List of business identifiers.
     *
     * @var null|list<Identifier> $identifiers
     */
    #[Api(type: new ListOf(Identifier::class), optional: true)]
    public ?array $identifiers;

    /**
     * Business entity name.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Registration date.
     */
    #[Api('registration_date', optional: true)]
    public ?string $registrationDate;

    /**
     * Website URL.
     */
    #[Api(optional: true)]
    public ?string $website;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<Identifier> $identifiers
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
        $obj = new self;

        null !== $additionalInfo && $obj->additionalInfo = $additionalInfo;
        null !== $countryCode && $obj->countryCode = $countryCode;
        null !== $geoInfo && $obj->geoInfo = $geoInfo;
        null !== $identifiers && $obj->identifiers = $identifiers;
        null !== $name && $obj->name = $name;
        null !== $registrationDate && $obj->registrationDate = $registrationDate;
        null !== $website && $obj->website = $website;

        return $obj;
    }

    /**
     * Additional information.
     */
    public function withAdditionalInfo(?string $additionalInfo): self
    {
        $obj = clone $this;
        $obj->additionalInfo = $additionalInfo;

        return $obj;
    }

    /**
     * Country code.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $obj = clone $this;
        $obj->countryCode = $countryCode;

        return $obj;
    }

    /**
     * Geographic information.
     */
    public function withGeoInfo(?string $geoInfo): self
    {
        $obj = clone $this;
        $obj->geoInfo = $geoInfo;

        return $obj;
    }

    /**
     * List of business identifiers.
     *
     * @param list<Identifier> $identifiers
     */
    public function withIdentifiers(array $identifiers): self
    {
        $obj = clone $this;
        $obj->identifiers = $identifiers;

        return $obj;
    }

    /**
     * Business entity name.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Registration date.
     */
    public function withRegistrationDate(?string $registrationDate): self
    {
        $obj = clone $this;
        $obj->registrationDate = $registrationDate;

        return $obj;
    }

    /**
     * Website URL.
     */
    public function withWebsite(?string $website): self
    {
        $obj = clone $this;
        $obj->website = $website;

        return $obj;
    }
}
