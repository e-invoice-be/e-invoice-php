<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\BusinessCard\Entity;

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
     * You must use named parameters to construct this object.
     *
     * @param list<Entity> $entities
     */
    final public function __construct(
        array $entities,
        float $queryTimeMs,
        string $status,
        ?string $error = null
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->entities = $entities;
        $this->queryTimeMs = $queryTimeMs;
        $this->status = $status;

        null !== $error && $this->error = $error;
    }
}
