<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\DocumentType;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

/**
 * Service metadata information for the Peppol participant.
 *
 * @phpstan-type ServiceMetadataShape = array{
 *   endpoints: list<Endpoint>,
 *   queryTimeMs: float,
 *   status: string,
 *   error?: string|null,
 * }
 */
final class ServiceMetadata implements BaseModel
{
    /** @use SdkModel<ServiceMetadataShape> */
    use SdkModel;

    /**
     * List of endpoints found for the Peppol participant.
     *
     * @var list<Endpoint> $endpoints
     */
    #[Required(list: Endpoint::class)]
    public array $endpoints;

    /**
     * Time taken to query the service metadata in milliseconds.
     */
    #[Required]
    public float $queryTimeMs;

    /**
     * Status of the service metadata lookup: 'success', 'error', or 'pending'.
     */
    #[Required]
    public string $status;

    /**
     * Error message if service metadata lookup failed.
     */
    #[Optional(nullable: true)]
    public ?string $error;

    /**
     * `new ServiceMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ServiceMetadata::with(endpoints: ..., queryTimeMs: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ServiceMetadata)->withEndpoints(...)->withQueryTimeMs(...)->withStatus(...)
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
     * @param list<Endpoint|array{
     *   documentTypes: list<DocumentType>,
     *   status: string,
     *   url: string,
     *   error?: string|null,
     *   processes?: list<Process>|null,
     * }> $endpoints
     */
    public static function with(
        array $endpoints,
        float $queryTimeMs,
        string $status,
        ?string $error = null
    ): self {
        $obj = new self;

        $obj['endpoints'] = $endpoints;
        $obj['queryTimeMs'] = $queryTimeMs;
        $obj['status'] = $status;

        null !== $error && $obj['error'] = $error;

        return $obj;
    }

    /**
     * List of endpoints found for the Peppol participant.
     *
     * @param list<Endpoint|array{
     *   documentTypes: list<DocumentType>,
     *   status: string,
     *   url: string,
     *   error?: string|null,
     *   processes?: list<Process>|null,
     * }> $endpoints
     */
    public function withEndpoints(array $endpoints): self
    {
        $obj = clone $this;
        $obj['endpoints'] = $endpoints;

        return $obj;
    }

    /**
     * Time taken to query the service metadata in milliseconds.
     */
    public function withQueryTimeMs(float $queryTimeMs): self
    {
        $obj = clone $this;
        $obj['queryTimeMs'] = $queryTimeMs;

        return $obj;
    }

    /**
     * Status of the service metadata lookup: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Error message if service metadata lookup failed.
     */
    public function withError(?string $error): self
    {
        $obj = clone $this;
        $obj['error'] = $error;

        return $obj;
    }
}
