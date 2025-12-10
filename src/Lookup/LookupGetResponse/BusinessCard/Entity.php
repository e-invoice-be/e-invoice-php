<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\BusinessCard;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Business entity information in the Peppol network.
 *
 * @phpstan-type EntityShape = array{
 *   additionalInformation?: list<string>|null,
 *   countryCode?: string|null,
 *   name?: string|null,
 *   registrationDate?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    /**
     * Additional information about the business entity.
     *
     * @var list<string>|null $additionalInformation
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $additionalInformation;

    /**
     * ISO 3166-1 alpha-2 country code of the business entity.
     */
    #[Optional(nullable: true)]
    public ?string $countryCode;

    /**
     * Name of the business entity.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * ISO 8601 date of when the entity was registered in Peppol.
     */
    #[Optional(nullable: true)]
    public ?string $registrationDate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $additionalInformation
     */
    public static function with(
        ?array $additionalInformation = null,
        ?string $countryCode = null,
        ?string $name = null,
        ?string $registrationDate = null,
    ): self {
        $self = new self;

        null !== $additionalInformation && $self['additionalInformation'] = $additionalInformation;
        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $name && $self['name'] = $name;
        null !== $registrationDate && $self['registrationDate'] = $registrationDate;

        return $self;
    }

    /**
     * Additional information about the business entity.
     *
     * @param list<string>|null $additionalInformation
     */
    public function withAdditionalInformation(
        ?array $additionalInformation
    ): self {
        $self = clone $this;
        $self['additionalInformation'] = $additionalInformation;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code of the business entity.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Name of the business entity.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * ISO 8601 date of when the entity was registered in Peppol.
     */
    public function withRegistrationDate(?string $registrationDate): self
    {
        $self = clone $this;
        $self['registrationDate'] = $registrationDate;

        return $self;
    }
}
