<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant\Entity\Identifier;

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

    /**
     * You must use named parameters to construct this object.
     *
     * @param null|list<Identifier> $identifiers
     */
    final public function __construct(
        ?string $additionalInfo = null,
        ?string $countryCode = null,
        ?string $geoInfo = null,
        ?array $identifiers = null,
        ?string $name = null,
        ?string $registrationDate = null,
        ?string $website = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        null !== $additionalInfo && $this->additionalInfo = $additionalInfo;
        null !== $countryCode && $this->countryCode = $countryCode;
        null !== $geoInfo && $this->geoInfo = $geoInfo;
        null !== $identifiers && $this->identifiers = $identifiers;
        null !== $name && $this->name = $name;
        null !== $registrationDate && $this->registrationDate = $registrationDate;
        null !== $website && $this->website = $website;
    }
}
