<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Business card information for the Peppol ID.
 *
 * @phpstan-type BusinessCardShape = array{
 *   country_code?: string|null,
 *   name?: string|null,
 *   registration_date?: \DateTimeInterface|null,
 * }
 */
final class BusinessCard implements BaseModel
{
    /** @use SdkModel<BusinessCardShape> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $country_code;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $registration_date;

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
        ?string $country_code = null,
        ?string $name = null,
        ?\DateTimeInterface $registration_date = null,
    ): self {
        $obj = new self;

        null !== $country_code && $obj['country_code'] = $country_code;
        null !== $name && $obj['name'] = $name;
        null !== $registration_date && $obj['registration_date'] = $registration_date;

        return $obj;
    }

    public function withCountryCode(?string $countryCode): self
    {
        $obj = clone $this;
        $obj['country_code'] = $countryCode;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withRegistrationDate(
        ?\DateTimeInterface $registrationDate
    ): self {
        $obj = clone $this;
        $obj['registration_date'] = $registrationDate;

        return $obj;
    }
}
