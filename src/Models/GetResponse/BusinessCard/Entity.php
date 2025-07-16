<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse\BusinessCard;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Core\Serde\UnionOf;

final class Entity implements BaseModel
{
    use Model;

    /** @var null|list<string> $additionalInformation */
    #[Api(type: new UnionOf([new ListOf('string'), 'null']), optional: true)]
    public ?array $additionalInformation;

    #[Api(optional: true)]
    public ?string $countryCode;

    #[Api(optional: true)]
    public ?string $name;

    #[Api(optional: true)]
    public ?string $registrationDate;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|list<string> $additionalInformation
     * @param null|string       $countryCode
     * @param null|string       $name
     * @param null|string       $registrationDate
     */
    final public function __construct(
        $additionalInformation = None::NOT_GIVEN,
        $countryCode = None::NOT_GIVEN,
        $name = None::NOT_GIVEN,
        $registrationDate = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Entity::_loadMetadata();
