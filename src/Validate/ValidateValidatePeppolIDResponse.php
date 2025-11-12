<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;
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
final class ValidateValidatePeppolIDResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<ValidateValidatePeppolIDResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Business card information for the Peppol ID.
     */
    #[Api]
    public ?BusinessCard $business_card;

    /**
     * Whether a business card is set at the SMP.
     */
    #[Api]
    public bool $business_card_valid;

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    #[Api]
    public bool $dns_valid;

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    #[Api]
    public bool $is_valid;

    /** @var list<string>|null $supported_document_types */
    #[Api(list: 'string', optional: true)]
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
     * @param list<string> $supported_document_types
     */
    public static function with(
        ?BusinessCard $business_card,
        bool $business_card_valid,
        bool $dns_valid,
        bool $is_valid,
        ?array $supported_document_types = null,
    ): self {
        $obj = new self;

        $obj->business_card = $business_card;
        $obj->business_card_valid = $business_card_valid;
        $obj->dns_valid = $dns_valid;
        $obj->is_valid = $is_valid;

        null !== $supported_document_types && $obj->supported_document_types = $supported_document_types;

        return $obj;
    }

    /**
     * Business card information for the Peppol ID.
     */
    public function withBusinessCard(?BusinessCard $businessCard): self
    {
        $obj = clone $this;
        $obj->business_card = $businessCard;

        return $obj;
    }

    /**
     * Whether a business card is set at the SMP.
     */
    public function withBusinessCardValid(bool $businessCardValid): self
    {
        $obj = clone $this;
        $obj->business_card_valid = $businessCardValid;

        return $obj;
    }

    /**
     * Whether the DNS resolves to a valid SMP.
     */
    public function withDNSValid(bool $dnsValid): self
    {
        $obj = clone $this;
        $obj->dns_valid = $dnsValid;

        return $obj;
    }

    /**
     * Whether the Peppol ID is valid and registered in the Peppol network.
     */
    public function withIsValid(bool $isValid): self
    {
        $obj = clone $this;
        $obj->is_valid = $isValid;

        return $obj;
    }

    /**
     * @param list<string> $supportedDocumentTypes
     */
    public function withSupportedDocumentTypes(
        array $supportedDocumentTypes
    ): self {
        $obj = clone $this;
        $obj->supported_document_types = $supportedDocumentTypes;

        return $obj;
    }
}
