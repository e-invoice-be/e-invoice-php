<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\BusinessCard;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;

/**
 * Business entity information in the Peppol network.
 *
 * @phpstan-type entity_alias = array{
 *   additionalInformation?: list<string>|null,
 *   countryCode?: string|null,
 *   name?: string|null,
 *   registrationDate?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    use Model;

    /**
     * Additional information about the business entity.
     *
     * @var null|list<string> $additionalInformation
     */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $additionalInformation;

    /**
     * ISO 3166-1 alpha-2 country code of the business entity.
     */
    #[Api(optional: true)]
    public ?string $countryCode;

    /**
     * Name of the business entity.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * ISO 8601 date of when the entity was registered in Peppol.
     */
    #[Api(optional: true)]
    public ?string $registrationDate;

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
     * @param null|list<string> $additionalInformation
     */
    public static function from(
        ?array $additionalInformation = null,
        ?string $countryCode = null,
        ?string $name = null,
        ?string $registrationDate = null,
    ): self {
        $obj = new self;

        null !== $additionalInformation && $obj->additionalInformation = $additionalInformation;
        null !== $countryCode && $obj->countryCode = $countryCode;
        null !== $name && $obj->name = $name;
        null !== $registrationDate && $obj->registrationDate = $registrationDate;

        return $obj;
    }

    /**
     * Additional information about the business entity.
     *
     * @param null|list<string> $additionalInformation
     */
    public function setAdditionalInformation(
        ?array $additionalInformation
    ): self {
        $this->additionalInformation = $additionalInformation;

        return $this;
    }

    /**
     * ISO 3166-1 alpha-2 country code of the business entity.
     */
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Name of the business entity.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * ISO 8601 date of when the entity was registered in Peppol.
     */
    public function setRegistrationDate(?string $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }
}
