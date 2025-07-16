<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|BusinessCard $businessCard           `required`
     * @param bool              $businessCardValid      `required`
     * @param bool              $dnsValid               `required`
     * @param bool              $isValid                `required`
     * @param null|list<string> $supportedDocumentTypes
     */
    final public function __construct(
        $businessCard,
        $businessCardValid,
        $dnsValid,
        $isValid,
        $supportedDocumentTypes = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

ValidatePeppolIDResponse::_loadMetadata();
