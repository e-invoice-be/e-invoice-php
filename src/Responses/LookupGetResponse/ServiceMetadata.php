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
     * @param list<Endpoint> $endpoints
     */
    public static function new(
        array $endpoints,
        float $queryTimeMs,
        string $status,
        ?string $error = null
    ): self {
        $obj = new self;

        $obj->endpoints = $endpoints;
        $obj->queryTimeMs = $queryTimeMs;
        $obj->status = $status;

        null !== $error && $obj->error = $error;

        return $obj;
    }

    /**
     * List of endpoints found for the Peppol participant.
     *
     * @param list<Endpoint> $endpoints
     */
    public function setEndpoints(array $endpoints): self
    {
        $this->endpoints = $endpoints;

        return $this;
    }

    /**
     * Time taken to query the service metadata in milliseconds.
     */
    public function setQueryTimeMs(float $queryTimeMs): self
    {
        $this->queryTimeMs = $queryTimeMs;

        return $this;
    }

    /**
     * Status of the service metadata lookup: 'success', 'error', or 'pending'.
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Error message if service metadata lookup failed.
     */
    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }
}
