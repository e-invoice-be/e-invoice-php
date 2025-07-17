<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetParticipantsResponse\Participant\Entity\Identifier;

final class Entity implements BaseModel
{
    use Model;

    #[Api('additional_info', optional: true)]
    public ?string $additionalInfo;

    #[Api('country_code', optional: true)]
    public ?string $countryCode;

    #[Api('geo_info', optional: true)]
    public ?string $geoInfo;

    /** @var null|list<Identifier> $identifiers */
    #[Api(type: new ListOf(Identifier::class), optional: true)]
    public ?array $identifiers;

    #[Api(optional: true)]
    public ?string $name;

    #[Api('registration_date', optional: true)]
    public ?string $registrationDate;

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
        $this->additionalInfo = $additionalInfo;
        $this->countryCode = $countryCode;
        $this->geoInfo = $geoInfo;
        $this->identifiers = $identifiers;
        $this->name = $name;
        $this->registrationDate = $registrationDate;
        $this->website = $website;
    }
}

Entity::__introspect();
