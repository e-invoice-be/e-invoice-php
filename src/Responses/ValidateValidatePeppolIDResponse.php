<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\ValidateValidatePeppolIDResponse\BusinessCard;

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
     * You must use named parameters to construct this object.
     *
     * @param null|list<string> $supportedDocumentTypes
     */
    final public function __construct(
        ?BusinessCard $businessCard,
        bool $businessCardValid,
        bool $dnsValid,
        bool $isValid,
        ?array $supportedDocumentTypes = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->businessCard = $businessCard;
        $this->businessCardValid = $businessCardValid;
        $this->dnsValid = $dnsValid;
        $this->isValid = $isValid;

        null !== $supportedDocumentTypes && $this
            ->supportedDocumentTypes = $supportedDocumentTypes
        ;
    }
}
