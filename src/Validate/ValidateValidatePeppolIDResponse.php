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
 *   business_card: BusinessCard|null,
 *   business_card_valid: bool,
 *   dns_valid: bool,
 *   is_valid: bool,
 *   supported_document_types?: list<string>|null,
 * }
 */
final class ValidateValidatePeppolIDResponse implements BaseModel
{
    /** @use SdkModel<ValidateValidatePeppolIDResponseShape> */
    use SdkModel;

    /**
     * Business card information for the Peppol ID.
     */
    #[Required]
    public ?BusinessCard $business_card;

    /**
     * Whether a business card is set at the SMP.
     */
    #[Required]
    public bool $business_card_valid;

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    #[Required]
    public bool $dns_valid;

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    #[Required]
    public bool $is_valid;

    /** @var list<string>|null $supported_document_types */
    #[Optional(list: 'string')]
    public ?array $supported_document_types;

    /**
     * `new ValidateValidatePeppolIDResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ValidateValidatePeppolIDResponse::with(
     *   business_card: ..., business_card_valid: ..., dns_valid: ..., is_valid: ...
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
     *   country_code?: string|null,
     *   name?: string|null,
     *   registration_date?: \DateTimeInterface|null,
     * }|null $business_card
     * @param list<string> $supported_document_types
     */
    public static function with(
        BusinessCard|array|null $business_card,
        bool $business_card_valid,
        bool $dns_valid,
        bool $is_valid,
        ?array $supported_document_types = null,
    ): self {
        $obj = new self;

        $obj['business_card'] = $business_card;
        $obj['business_card_valid'] = $business_card_valid;
        $obj['dns_valid'] = $dns_valid;
        $obj['is_valid'] = $is_valid;

        null !== $supported_document_types && $obj['supported_document_types'] = $supported_document_types;

        return $obj;
    }

    /**
     * Business card information for the Peppol ID.
     *
     * @param BusinessCard|array{
     *   country_code?: string|null,
     *   name?: string|null,
     *   registration_date?: \DateTimeInterface|null,
     * }|null $businessCard
     */
    public function withBusinessCard(
        BusinessCard|array|null $businessCard
    ): self {
        $obj = clone $this;
        $obj['business_card'] = $businessCard;

        return $obj;
    }

    /**
     * Whether a business card is set at the SMP.
     */
    public function withBusinessCardValid(bool $businessCardValid): self
    {
        $obj = clone $this;
        $obj['business_card_valid'] = $businessCardValid;

        return $obj;
    }

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    public function withDNSValid(bool $dnsValid): self
    {
        $obj = clone $this;
        $obj['dns_valid'] = $dnsValid;

        return $obj;
    }

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    public function withIsValid(bool $isValid): self
    {
        $obj = clone $this;
        $obj['is_valid'] = $isValid;

        return $obj;
    }

    /**
     * @param list<string> $supportedDocumentTypes
     */
    public function withSupportedDocumentTypes(
        array $supportedDocumentTypes
    ): self {
        $obj = clone $this;
        $obj['supported_document_types'] = $supportedDocumentTypes;

        return $obj;
    }
}
