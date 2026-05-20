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
 * @phpstan-import-type BusinessCardShape from \EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse\BusinessCard
 *
 * @phpstan-type ValidateValidatePeppolIDResponseShape = array{
 *   businessCardValid: bool,
 *   dnsValid: bool,
 *   isValid: bool,
 *   supportedDocumentTypes: list<string>,
 *   businessCard?: null|BusinessCard|BusinessCardShape,
 * }
 */
final class ValidateValidatePeppolIDResponse implements BaseModel
{
    /** @use SdkModel<ValidateValidatePeppolIDResponseShape> */
    use SdkModel;

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

    /**
     * List of document types that this Peppol ID supports.
     *
     * @var list<string> $supportedDocumentTypes
     */
    #[Required('supported_document_types', list: 'string')]
    public array $supportedDocumentTypes;

    /**
     * Business card information for the Peppol ID.
     */
    #[Optional('business_card', nullable: true)]
    public ?BusinessCard $businessCard;

    /**
     * `new ValidateValidatePeppolIDResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ValidateValidatePeppolIDResponse::with(
     *   businessCardValid: ...,
     *   dnsValid: ...,
     *   isValid: ...,
     *   supportedDocumentTypes: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ValidateValidatePeppolIDResponse)
     *   ->withBusinessCardValid(...)
     *   ->withDNSValid(...)
     *   ->withIsValid(...)
     *   ->withSupportedDocumentTypes(...)
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
     * @param list<string> $supportedDocumentTypes
     * @param BusinessCard|BusinessCardShape|null $businessCard
     */
    public static function with(
        bool $businessCardValid,
        bool $dnsValid,
        bool $isValid,
        array $supportedDocumentTypes,
        BusinessCard|array|null $businessCard = null,
    ): self {
        $self = new self;

        $self['businessCardValid'] = $businessCardValid;
        $self['dnsValid'] = $dnsValid;
        $self['isValid'] = $isValid;
        $self['supportedDocumentTypes'] = $supportedDocumentTypes;

        null !== $businessCard && $self['businessCard'] = $businessCard;

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
     * List of document types that this Peppol ID supports.
     *
     * @param list<string> $supportedDocumentTypes
     */
    public function withSupportedDocumentTypes(
        array $supportedDocumentTypes
    ): self {
        $self = clone $this;
        $self['supportedDocumentTypes'] = $supportedDocumentTypes;

        return $self;
    }

    /**
     * Business card information for the Peppol ID.
     *
     * @param BusinessCard|BusinessCardShape|null $businessCard
     */
    public function withBusinessCard(
        BusinessCard|array|null $businessCard
    ): self {
        $self = clone $this;
        $self['businessCard'] = $businessCard;

        return $self;
    }
}
