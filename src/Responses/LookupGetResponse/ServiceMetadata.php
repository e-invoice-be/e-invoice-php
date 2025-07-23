<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint;

/**
 * Service metadata information for the Peppol participant.
 *
 * @phpstan-type service_metadata_alias = array{
 *   endpoints: list<Endpoint>,
 *   queryTimeMs: float,
 *   status: string,
 *   error?: string|null,
 * }
 */
final class ServiceMetadata implements BaseModel
{
    use Model;

    /**
     * List of endpoints found for the Peppol participant.
     *
     * @var list<Endpoint> $endpoints
     */
    #[Api(type: new ListOf(Endpoint::class))]
    public array $endpoints;

    /**
     * Time taken to query the service metadata in milliseconds.
     */
    #[Api]
    public float $queryTimeMs;

    /**
     * Status of the service metadata lookup: 'success', 'error', or 'pending'.
     */
    #[Api]
    public string $status;

    /**
     * Error message if service metadata lookup failed.
     */
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
