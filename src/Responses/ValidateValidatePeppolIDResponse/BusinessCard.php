<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\ValidateValidatePeppolIDResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Business card information for the Peppol ID.
 *
 * @phpstan-type business_card_alias = array{
 *   countryCode?: string|null,
 *   name?: string|null,
 *   registrationDate?: \DateTimeInterface|null,
 * }
 */
final class BusinessCard implements BaseModel
{
    use Model;

    #[Api('country_code', optional: true)]
    public ?string $countryCode;

    #[Api(optional: true)]
    public ?string $name;

    #[Api('registration_date', optional: true)]
    public ?\DateTimeInterface $registrationDate;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function new(
        ?string $countryCode = null,
        ?string $name = null,
        ?\DateTimeInterface $registrationDate = null,
    ): self {
        $obj = new self;

        null !== $countryCode && $obj->countryCode = $countryCode;
        null !== $name && $obj->name = $name;
        null !== $registrationDate && $obj->registrationDate = $registrationDate;

        return $obj;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setRegistrationDate(
        ?\DateTimeInterface $registrationDate
    ): self {
        $this->registrationDate = $registrationDate;

        return $this;
    }
}
