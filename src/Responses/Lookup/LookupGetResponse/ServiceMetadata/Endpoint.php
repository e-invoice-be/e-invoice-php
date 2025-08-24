<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\DocumentType;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

/**
 * Information about a Peppol participant's endpoint.
 */
final class Endpoint implements BaseModel
{
    use SdkModel;

    /**
     * List of document types supported by this endpoint.
     *
     * @var list<DocumentType> $documentTypes
     */
    #[Api(list: DocumentType::class)]
    public array $documentTypes;

    /**
     * Status of the endpoint lookup: 'success', 'error', or 'pending'.
     */
    #[Api]
    public string $status;

    /**
     * URL of the endpoint.
     */
    #[Api]
    public string $url;

    /**
     * Error message if endpoint lookup failed.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $error;

    /**
     * List of processes supported by this endpoint.
     *
     * @var list<Process>|null $processes
     */
    #[Api(list: Process::class, nullable: true, optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DocumentType> $documentTypes
     * @param list<Process>|null $processes
     */
    public static function with(
        array $documentTypes,
        string $status,
        string $url,
        ?string $error = null,
        ?array $processes = null,
    ): self {
        $obj = new self;

        $obj->documentTypes = $documentTypes;
        $obj->status = $status;
        $obj->url = $url;

        null !== $error && $obj->error = $error;
        null !== $processes && $obj->processes = $processes;

        return $obj;
    }

    /**
     * List of document types supported by this endpoint.
     *
     * @param list<DocumentType> $documentTypes
     */
    public function withDocumentTypes(array $documentTypes): self
    {
        $obj = clone $this;
        $obj->documentTypes = $documentTypes;

        return $obj;
    }

    /**
     * Status of the endpoint lookup: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * URL of the endpoint.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * Error message if endpoint lookup failed.
     */
    public function withError(?string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }

    /**
     * List of processes supported by this endpoint.
     *
     * @param list<Process>|null $processes
     */
    public function withProcesses(?array $processes): self
    {
        $obj = clone $this;
        $obj->processes = $processes;

        return $obj;
    }
}
