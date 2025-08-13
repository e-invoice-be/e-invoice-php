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
    public static function from(
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
    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;

        return $this;
    }

    /**
     * Country code.
     */
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Geographic information.
     */
    public function setGeoInfo(?string $geoInfo): self
    {
        $this->geoInfo = $geoInfo;

        return $this;
    }

    /**
     * List of business identifiers.
     *
     * @param list<Identifier> $identifiers
     */
    public function setIdentifiers(array $identifiers): self
    {
        $this->identifiers = $identifiers;

        return $this;
    }

    /**
     * Business entity name.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Registration date.
     */
    public function setRegistrationDate(?string $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Website URL.
     */
    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }
}
