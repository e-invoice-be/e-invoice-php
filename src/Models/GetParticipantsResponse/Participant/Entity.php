<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|string           $additionalInfo
     * @param null|string           $countryCode
     * @param null|string           $geoInfo
     * @param null|list<Identifier> $identifiers
     * @param null|string           $name
     * @param null|string           $registrationDate
     * @param null|string           $website
     */
    final public function __construct(
        $additionalInfo = None::NOT_GIVEN,
        $countryCode = None::NOT_GIVEN,
        $geoInfo = None::NOT_GIVEN,
        $identifiers = None::NOT_GIVEN,
        $name = None::NOT_GIVEN,
        $registrationDate = None::NOT_GIVEN,
        $website = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Entity::_loadMetadata();
