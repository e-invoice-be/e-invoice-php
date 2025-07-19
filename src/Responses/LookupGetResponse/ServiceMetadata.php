<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint;

final class ServiceMetadata implements BaseModel
{
    use Model;

    /** @var list<Endpoint> $endpoints */
    #[Api(type: new ListOf(Endpoint::class))]
    public array $endpoints;

    #[Api]
    public float $queryTimeMs;

    #[Api]
    public string $status;

    #[Api(optional: true)]
    public ?string $error;

    /**
     * You must use named parameters to construct this object.
     *
     * @param list<Endpoint> $endpoints
     */
    final public function __construct(
        array $endpoints,
        float $queryTimeMs,
        string $status,
        ?string $error = null
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->endpoints = $endpoints;
        $this->queryTimeMs = $queryTimeMs;
        $this->status = $status;

        null !== $error && $this->error = $error;
    }
}
