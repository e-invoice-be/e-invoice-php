<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\BusinessCard\Entity;

final class BusinessCard implements BaseModel
{
    use Model;

    /** @var list<Entity> $entities */
    #[Api(type: new ListOf(Entity::class))]
    public array $entities;

    #[Api]
    public float $queryTimeMs;

    #[Api]
    public string $status;

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
