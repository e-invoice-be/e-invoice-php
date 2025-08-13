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
    public static function from(
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
    public function setBusinessCard(?BusinessCard $businessCard): self
    {
        $this->businessCard = $businessCard;

        return $this;
    }

    /**
     * Whether a business card is set at the SMP.
     */
    public function setBusinessCardValid(bool $businessCardValid): self
    {
        $this->businessCardValid = $businessCardValid;

        return $this;
    }

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    public function setDNSValid(bool $dnsValid): self
    {
        $this->dnsValid = $dnsValid;

        return $this;
    }

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @param list<string> $supportedDocumentTypes
     */
    public function setSupportedDocumentTypes(
        array $supportedDocumentTypes
    ): self {
        $this->supportedDocumentTypes = $supportedDocumentTypes;

        return $this;
    }
}
