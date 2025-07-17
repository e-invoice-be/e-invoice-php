<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetResponse\BusinessCard\Entity;

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
        $this->entities = $entities;
        $this->queryTimeMs = $queryTimeMs;
        $this->status = $status;
        $this->error = $error;
    }
}

BusinessCard::__introspect();
