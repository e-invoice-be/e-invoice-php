<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse\BusinessCard;

/**
 * Response for a Peppol ID validation request.
 *
 * This model represents the validation result of a Peppol ID in the Peppol network,
 * including whether the ID is valid and what document types it supports.
 *
 * @phpstan-type ValidateValidatePeppolIDResponseShape = array{
 *   businessCard: BusinessCard|null,
 *   businessCardValid: bool,
 *   dnsValid: bool,
 *   isValid: bool,
 *   supportedDocumentTypes?: list<string>|null,
 * }
 */
final class ValidateValidatePeppolIDResponse implements BaseModel
{
    /** @use SdkModel<ValidateValidatePeppolIDResponseShape> */
    use SdkModel;

    /**
     * Business card information for the Peppol ID.
     */
    #[Required('business_card')]
    public ?BusinessCard $businessCard;

    /**
     * Whether a business card is set at the SMP.
     */
    #[Required('business_card_valid')]
    public bool $businessCardValid;

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    #[Required('dns_valid')]
    public bool $dnsValid;

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    #[Required('is_valid')]
    public bool $isValid;

    /** @var list<string>|null $supportedDocumentTypes */
    #[Optional('supported_document_types', list: 'string')]
    public ?array $supportedDocumentTypes;

    /**
     * `new ValidateValidatePeppolIDResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ValidateValidatePeppolIDResponse::with(
     *   businessCard: ..., businessCardValid: ..., dnsValid: ..., isValid: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ValidateValidatePeppolIDResponse)
     *   ->withBusinessCard(...)
     *   ->withBusinessCardValid(...)
     *   ->withDNSValid(...)
     *   ->withIsValid(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BusinessCard|array{
     *   countryCode?: string|null, name?: string|null, registrationDate?: string|null
     * }|null $businessCard
     * @param list<string> $supportedDocumentTypes
     */
    public static function with(
        BusinessCard|array|null $businessCard,
        bool $businessCardValid,
        bool $dnsValid,
        bool $isValid,
        ?array $supportedDocumentTypes = null,
    ): self {
        $self = new self;

        $self['businessCard'] = $businessCard;
        $self['businessCardValid'] = $businessCardValid;
        $self['dnsValid'] = $dnsValid;
        $self['isValid'] = $isValid;

        null !== $supportedDocumentTypes && $self['supportedDocumentTypes'] = $supportedDocumentTypes;

        return $self;
    }

    /**
     * Business card information for the Peppol ID.
     *
     * @param BusinessCard|array{
     *   countryCode?: string|null, name?: string|null, registrationDate?: string|null
     * }|null $businessCard
     */
    public function withBusinessCard(
        BusinessCard|array|null $businessCard
    ): self {
        $self = clone $this;
        $self['businessCard'] = $businessCard;

        return $self;
    }

    /**
     * Whether a business card is set at the SMP.
     */
    public function withBusinessCardValid(bool $businessCardValid): self
    {
        $self = clone $this;
        $self['businessCardValid'] = $businessCardValid;

        return $self;
    }

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    public function withDNSValid(bool $dnsValid): self
    {
        $self = clone $this;
        $self['dnsValid'] = $dnsValid;

        return $self;
    }

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    public function withIsValid(bool $isValid): self
    {
        $self = clone $this;
        $self['isValid'] = $isValid;

        return $self;
    }

    /**
     * @param list<string> $supportedDocumentTypes
     */
    public function withSupportedDocumentTypes(
        array $supportedDocumentTypes
    ): self {
        $self = clone $this;
        $self['supportedDocumentTypes'] = $supportedDocumentTypes;

        return $self;
    }
}
