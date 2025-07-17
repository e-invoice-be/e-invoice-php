<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\ValidatePeppolIDResponse\BusinessCard;

final class ValidatePeppolIDResponse implements BaseModel
{
    use Model;

    #[Api('business_card')]
    public ?BusinessCard $businessCard;

    #[Api('business_card_valid')]
    public bool $businessCardValid;

    #[Api('dns_valid')]
    public bool $dnsValid;

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
        $this->businessCard = $businessCard;
        $this->businessCardValid = $businessCardValid;
        $this->dnsValid = $dnsValid;
        $this->isValid = $isValid;

        self::_introspect();
        $this->unsetOptionalProperties();

        null != $supportedDocumentTypes && $this->supportedDocumentTypes = $supportedDocumentTypes;
    }
}
