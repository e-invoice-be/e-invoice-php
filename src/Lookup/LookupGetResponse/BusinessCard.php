<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetResponse\BusinessCard\Entity;

/**
 * Business card information for the Peppol participant.
 *
 * @phpstan-type BusinessCardShape = array{
 *   entities: list<Entity>,
 *   queryTimeMs: float,
 *   status: string,
 *   error?: string|null,
 * }
 */
final class BusinessCard implements BaseModel
{
    /** @use SdkModel<BusinessCardShape> */
    use SdkModel;

    /**
     * List of business entities associated with the Peppol ID.
     *
     * @var list<Entity> $entities
     */
    #[Required(list: Entity::class)]
    public array $entities;

    /**
     * Time taken to query the business card in milliseconds.
     */
    #[Required]
    public float $queryTimeMs;

    /**
     * Status of the business card lookup: 'success', 'error', or 'pending'.
     */
    #[Required]
    public string $status;

    /**
     * Error message if business card lookup failed.
     */
    #[Optional(nullable: true)]
    public ?string $error;

    /**
     * `new BusinessCard()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BusinessCard::with(entities: ..., queryTimeMs: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BusinessCard)->withEntities(...)->withQueryTimeMs(...)->withStatus(...)
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
     * @param list<Entity|array{
     *   additionalInformation?: list<string>|null,
     *   countryCode?: string|null,
     *   name?: string|null,
     *   registrationDate?: string|null,
     * }> $entities
     */
    public static function with(
        array $entities,
        float $queryTimeMs,
        string $status,
        ?string $error = null
    ): self {
        $self = new self;

        $self['entities'] = $entities;
        $self['queryTimeMs'] = $queryTimeMs;
        $self['status'] = $status;

        null !== $error && $self['error'] = $error;

        return $self;
    }

    /**
     * List of business entities associated with the Peppol ID.
     *
     * @param list<Entity|array{
     *   additionalInformation?: list<string>|null,
     *   countryCode?: string|null,
     *   name?: string|null,
     *   registrationDate?: string|null,
     * }> $entities
     */
    public function withEntities(array $entities): self
    {
        $self = clone $this;
        $self['entities'] = $entities;

        return $self;
    }

    /**
     * Time taken to query the business card in milliseconds.
     */
    public function withQueryTimeMs(float $queryTimeMs): self
    {
        $self = clone $this;
        $self['queryTimeMs'] = $queryTimeMs;

        return $self;
    }

    /**
     * Status of the business card lookup: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Error message if business card lookup failed.
     */
    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
