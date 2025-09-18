<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Business card information for the Peppol ID.
 *
 * @phpstan-type business_card = array{
 *   countryCode?: string|null,
 *   name?: string|null,
 *   registrationDate?: \DateTimeInterface|null,
 * }
 */
final class BusinessCard implements BaseModel
{
    /** @use SdkModel<business_card> */
    use SdkModel;

    #[Api('country_code', nullable: true, optional: true)]
    public ?string $countryCode;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api('registration_date', nullable: true, optional: true)]
    public ?\DateTimeInterface $registrationDate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
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

    public function withCountryCode(?string $countryCode): self
    {
        $obj = clone $this;
        $obj->countryCode = $countryCode;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withRegistrationDate(
        ?\DateTimeInterface $registrationDate
    ): self {
        $obj = clone $this;
        $obj->registrationDate = $registrationDate;

        return $obj;
    }
}
