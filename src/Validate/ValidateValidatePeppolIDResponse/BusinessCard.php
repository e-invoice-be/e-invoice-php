<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Business card information for the Peppol ID.
 *
 * @phpstan-type BusinessCardShape = array{
 *   countryCode?: string|null,
 *   name?: string|null,
 *   registrationDate?: \DateTimeInterface|null,
 * }
 */
final class BusinessCard implements BaseModel
{
    /** @use SdkModel<BusinessCardShape> */
    use SdkModel;

    #[Optional('country_code', nullable: true)]
    public ?string $countryCode;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional('registration_date', nullable: true)]
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
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $name && $self['name'] = $name;
        null !== $registrationDate && $self['registrationDate'] = $registrationDate;

        return $self;
    }

    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withRegistrationDate(
        ?\DateTimeInterface $registrationDate
    ): self {
        $self = clone $this;
        $self['registrationDate'] = $registrationDate;

        return $self;
    }
}
