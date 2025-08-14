<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\Validate\ValidateValidatePeppolIDResponse\BusinessCard;

/**
 * Response for a Peppol ID validation request.
 *
 * This model represents the validation result of a Peppol ID in the Peppol network,
 * including whether the ID is valid and what document types it supports.
 *
 * @phpstan-type validate_validate_peppol_id_response_alias = array{
 *   businessCard: BusinessCard|null,
 *   businessCardValid: bool,
 *   dnsValid: bool,
 *   isValid: bool,
 *   supportedDocumentTypes?: list<string>,
 * }
 */
final class ValidateValidatePeppolIDResponse implements BaseModel
{
    use Model;

    /**
     * Business card information for the Peppol ID.
     */
    #[Api('business_card')]
    public ?BusinessCard $businessCard;

    /**
     * Whether a business card is set at the SMP.
     */
    #[Api('business_card_valid')]
    public bool $businessCardValid;

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    #[Api('dns_valid')]
    public bool $dnsValid;

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    #[Api('is_valid')]
    public bool $isValid;

    /** @var null|list<string> $supportedDocumentTypes */
    #[Api('supported_document_types', type: new ListOf('string'), optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<string> $supportedDocumentTypes
     */
    public static function with(
        ?BusinessCard $businessCard,
        bool $businessCardValid,
        bool $dnsValid,
        bool $isValid,
        ?array $supportedDocumentTypes = null,
    ): self {
        $obj = new self;

        $obj->businessCard = $businessCard;
        $obj->businessCardValid = $businessCardValid;
        $obj->dnsValid = $dnsValid;
        $obj->isValid = $isValid;

        null !== $supportedDocumentTypes && $obj->supportedDocumentTypes = $supportedDocumentTypes;

        return $obj;
    }

    /**
     * Business card information for the Peppol ID.
     */
    public function withBusinessCard(?BusinessCard $businessCard): self
    {
        $obj = clone $this;
        $obj->businessCard = $businessCard;

        return $obj;
    }

    /**
     * Whether a business card is set at the SMP.
     */
    public function withBusinessCardValid(bool $businessCardValid): self
    {
        $obj = clone $this;
        $obj->businessCardValid = $businessCardValid;

        return $obj;
    }

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    public function withDNSValid(bool $dnsValid): self
    {
        $obj = clone $this;
        $obj->dnsValid = $dnsValid;

        return $obj;
    }

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    public function withIsValid(bool $isValid): self
    {
        $obj = clone $this;
        $obj->isValid = $isValid;

        return $obj;
    }

    /**
     * @param list<string> $supportedDocumentTypes
     */
    public function withSupportedDocumentTypes(
        array $supportedDocumentTypes
    ): self {
        $obj = clone $this;
        $obj->supportedDocumentTypes = $supportedDocumentTypes;

        return $obj;
    }
}
