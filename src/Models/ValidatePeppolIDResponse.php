<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

class ValidatePeppolIDResponse implements BaseModel
{
    use Model;

    /**
     * @var array{
     *
     *     countryCode?: string|null,
     *     name?: string|null,
     *     registrationDate?: mixed|null,
     *
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

    /**
     * @var list<string> $supportedDocumentTypes
     */
    #[Api('supported_document_types', type: new ListOf('string'), optional: true)]
    public array $supportedDocumentTypes;

    /**
     * @param array{
     *
     *     countryCode?: string|null,
     *     name?: string|null,
     *     registrationDate?: mixed|null,
     *
     * }|null $businessCard
     * @param list<string> $supportedDocumentTypes
     */
    final public function __construct(
        ?array $businessCard,
        bool $businessCardValid,
        bool $dnsValid,
        bool $isValid,
        array|None $supportedDocumentTypes = None::NOT_SET,
    ) {

        $args = func_get_args();

        $data = [];
        for ($i = 0; $i < count($args); ++$i) {
            if (None::NOT_SET !== $args[$i]) {
                $data[self::$_constructorArgNames[$i]] = $args[$i] ?? null;
            }
        }

        $this->__unserialize($data);

    }
}

ValidatePeppolIDResponse::_loadMetadata();
