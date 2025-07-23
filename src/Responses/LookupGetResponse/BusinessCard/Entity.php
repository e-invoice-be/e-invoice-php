<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\BusinessCard;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;

/**
 * Business entity information in the Peppol network.
 *
 * @phpstan-type entity_alias = array{
 *   additionalInformation?: list<string>|null,
 *   countryCode?: string|null,
 *   name?: string|null,
 *   registrationDate?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    use Model;

    /**
     * Additional information about the business entity.
     *
     * @var null|list<string> $additionalInformation
     */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $additionalInformation;

    /**
     * ISO 3166-1 alpha-2 country code of the business entity.
     */
    #[Api(optional: true)]
    public ?string $countryCode;

    /**
     * Name of the business entity.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * ISO 8601 date of when the entity was registered in Peppol.
     */
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
        self::introspect();
        $this->unsetOptionalProperties();

        null !== $additionalInformation && $this
            ->additionalInformation = $additionalInformation
        ;
        null !== $countryCode && $this->countryCode = $countryCode;
        null !== $name && $this->name = $name;
        null !== $registrationDate && $this->registrationDate = $registrationDate;
    }
}
