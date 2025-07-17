<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse\BusinessCard;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
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
     * You must use named parameters to construct this object.
     *
     * @param null|list<string> $additionalInformation
     */
    final public function __construct(
        ?array $additionalInformation = null,
        ?string $countryCode = null,
        ?string $name = null,
        ?string $registrationDate = null,
    ) {
        $this->additionalInformation = $additionalInformation;
        $this->countryCode = $countryCode;
        $this->name = $name;
        $this->registrationDate = $registrationDate;
    }
}

Entity::__introspect();
