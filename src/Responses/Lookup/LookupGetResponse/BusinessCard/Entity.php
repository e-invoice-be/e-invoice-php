<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\BusinessCard;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;

/**
 * Business entity information in the Peppol network.
 */
final class Entity implements BaseModel
{
    use SdkModel;

    /**
     * Additional information about the business entity.
     *
     * @var list<string>|null $additionalInformation
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
     * @param list<string>|null $additionalInformation
     */
    public static function with(
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
     * @param list<string>|null $additionalInformation
     */
    public function withAdditionalInformation(
        ?array $additionalInformation
    ): self {
        $obj = clone $this;
        $obj->additionalInformation = $additionalInformation;

        return $obj;
    }

    /**
     * ISO 3166-1 alpha-2 country code of the business entity.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $obj = clone $this;
        $obj->countryCode = $countryCode;

        return $obj;
    }

    /**
     * Name of the business entity.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * ISO 8601 date of when the entity was registered in Peppol.
     */
    public function withRegistrationDate(?string $registrationDate): self
    {
        $obj = clone $this;
        $obj->registrationDate = $registrationDate;

        return $obj;
    }
}
