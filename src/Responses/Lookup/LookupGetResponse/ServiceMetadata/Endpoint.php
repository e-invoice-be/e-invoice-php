<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\DocumentType;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

/**
 * Information about a Peppol participant's endpoint.
 *
 * @phpstan-type endpoint_alias = array{
 *   documentTypes: list<DocumentType>,
 *   status: string,
 *   url: string,
 *   error?: string|null,
 *   processes?: list<Process>|null,
 * }
 */
final class Endpoint implements BaseModel
{
    use Model;

    /**
     * List of document types supported by this endpoint.
     *
     * @var list<DocumentType> $documentTypes
     */
    #[Api(type: new ListOf(DocumentType::class))]
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
    #[Api(optional: true)]
    public ?string $error;

    /**
     * List of processes supported by this endpoint.
     *
     * @var null|list<Process> $processes
     */
    #[Api(type: new ListOf(Process::class), nullable: true, optional: true)]
    public ?array $processes;

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
     * @param null|list<Process> $processes
     */
    public static function from(
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
    public function setDocumentTypes(array $documentTypes): self
    {
        $this->documentTypes = $documentTypes;

        return $this;
    }

    /**
     * Status of the endpoint lookup: 'success', 'error', or 'pending'.
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * URL of the endpoint.
     */
    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Error message if endpoint lookup failed.
     */
    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }

    /**
     * List of processes supported by this endpoint.
     *
     * @param null|list<Process> $processes
     */
    public function setProcesses(?array $processes): self
    {
        $this->processes = $processes;

        return $this;
    }
}
