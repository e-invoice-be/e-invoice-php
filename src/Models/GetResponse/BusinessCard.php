<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetResponse\BusinessCard\Entity;

class BusinessCard implements BaseModel
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param list<Entity> $entities    `required`
     * @param float        $queryTimeMs `required`
     * @param string       $status      `required`
     * @param null|string  $error
     */
    final public function __construct(
        $entities,
        $queryTimeMs,
        $status,
        $error = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

BusinessCard::_loadMetadata();
