<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse\BusinessCard\Entity;

/**
 * Business card information for the Peppol participant.
 *
 * @phpstan-type business_card_alias = array{
 *   entities: list<Entity>,
 *   queryTimeMs: float,
 *   status: string,
 *   error?: string|null,
 * }
 */
final class BusinessCard implements BaseModel
{
    use Model;

    /**
     * List of business entities associated with the Peppol ID.
     *
     * @var list<Entity> $entities
     */
    #[Api(type: new ListOf(Entity::class))]
    public array $entities;

    /**
     * Time taken to query the business card in milliseconds.
     */
    #[Api]
    public float $queryTimeMs;

    /**
     * Status of the business card lookup: 'success', 'error', or 'pending'.
     */
    #[Api]
    public string $status;

    /**
     * Error message if business card lookup failed.
     */
    #[Api(optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Entity> $entities
     */
    public static function with(
        array $entities,
        float $queryTimeMs,
        string $status,
        ?string $error = null
    ): self {
        $obj = new self;

        $obj->entities = $entities;
        $obj->queryTimeMs = $queryTimeMs;
        $obj->status = $status;

        null !== $error && $obj->error = $error;

        return $obj;
    }

    /**
     * List of business entities associated with the Peppol ID.
     *
     * @param list<Entity> $entities
     */
    public function withEntities(array $entities): self
    {
        $obj = clone $this;
        $obj->entities = $entities;

        return $obj;
    }

    /**
     * Time taken to query the business card in milliseconds.
     */
    public function withQueryTimeMs(float $queryTimeMs): self
    {
        $obj = clone $this;
        $obj->queryTimeMs = $queryTimeMs;

        return $obj;
    }

    /**
     * Status of the business card lookup: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * Error message if business card lookup failed.
     */
    public function withError(?string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }
}
