<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\DocumentType;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process\ProcessID;

/**
 * Information about a Peppol participant's endpoint.
 *
 * @phpstan-type EndpointShape = array{
 *   documentTypes: list<DocumentType>,
 *   status: string,
 *   url: string,
 *   error?: string|null,
 *   processes?: list<Process>|null,
 * }
 */
final class Endpoint implements BaseModel
{
    /** @use SdkModel<EndpointShape> */
    use SdkModel;

    /**
     * List of document types supported by this endpoint.
     *
     * @var list<DocumentType> $documentTypes
     */
    #[Required(list: DocumentType::class)]
    public array $documentTypes;

    /**
     * Status of the endpoint lookup: 'success', 'error', or 'pending'.
     */
    #[Required]
    public string $status;

    /**
     * URL of the endpoint.
     */
    #[Required]
    public string $url;

    /**
     * Error message if endpoint lookup failed.
     */
    #[Optional(nullable: true)]
    public ?string $error;

    /**
     * List of processes supported by this endpoint.
     *
     * @var list<Process>|null $processes
     */
    #[Optional(list: Process::class, nullable: true)]
    public ?array $processes;

    /**
     * `new Endpoint()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Endpoint::with(documentTypes: ..., status: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Endpoint)->withDocumentTypes(...)->withStatus(...)->withURL(...)
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
     * @param list<DocumentType|array{scheme: string, value: string}> $documentTypes
     * @param list<Process|array{
     *   endpoints: list<Process\Endpoint>,
     *   processID: ProcessID,
     * }>|null $processes
     */
    public static function with(
        array $documentTypes,
        string $status,
        string $url,
        ?string $error = null,
        ?array $processes = null,
    ): self {
        $self = new self;

        $self['documentTypes'] = $documentTypes;
        $self['status'] = $status;
        $self['url'] = $url;

        null !== $error && $self['error'] = $error;
        null !== $processes && $self['processes'] = $processes;

        return $self;
    }

    /**
     * List of document types supported by this endpoint.
     *
     * @param list<DocumentType|array{scheme: string, value: string}> $documentTypes
     */
    public function withDocumentTypes(array $documentTypes): self
    {
        $self = clone $this;
        $self['documentTypes'] = $documentTypes;

        return $self;
    }

    /**
     * Status of the endpoint lookup: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * URL of the endpoint.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Error message if endpoint lookup failed.
     */
    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * List of processes supported by this endpoint.
     *
     * @param list<Process|array{
     *   endpoints: list<Process\Endpoint>,
     *   processID: ProcessID,
     * }>|null $processes
     */
    public function withProcesses(?array $processes): self
    {
        $self = clone $this;
        $self['processes'] = $processes;

        return $self;
    }
}
