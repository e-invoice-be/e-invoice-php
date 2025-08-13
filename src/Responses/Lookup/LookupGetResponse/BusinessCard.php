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
    public static function from(
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
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * Time taken to query the business card in milliseconds.
     */
    public function setQueryTimeMs(float $queryTimeMs): self
    {
        $this->queryTimeMs = $queryTimeMs;

        return $this;
    }

    /**
     * Status of the business card lookup: 'success', 'error', or 'pending'.
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Error message if business card lookup failed.
     */
    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }
}
