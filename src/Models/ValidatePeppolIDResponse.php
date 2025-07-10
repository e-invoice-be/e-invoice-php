<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Core\Serde\UnionOf;

class ValidatePeppolIDResponse implements BaseModel
{
    use Model;

    /**
     * @var array{
     *   countryCode?: string|null,
     *   name?: string|null,
     *   registrationDate?: \DateTimeInterface|null,
     * }|null $businessCard
     */
    #[Api('business_card')]
    public ?array $businessCard;

    #[Api('business_card_valid')]
    public bool $businessCardValid;

    #[Api('dns_valid')]
    public bool $dnsValid;

    #[Api('is_valid')]
    public bool $isValid;

    /** @var null|list<string> $supportedDocumentTypes */
    #[Api(
        'supported_document_types',
        type: new UnionOf([new ListOf('string'), 'null']),
        optional: true,
    )]
    public ?array $supportedDocumentTypes;

    /**
     * @param array{
     *   countryCode?: string|null,
     *   name?: string|null,
     *   registrationDate?: \DateTimeInterface|null,
     * }|null $businessCard
     * @param bool              $businessCardValid
     * @param bool              $dnsValid
     * @param bool              $isValid
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
