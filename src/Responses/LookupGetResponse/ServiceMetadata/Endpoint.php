<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\DocumentType;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\Process;

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

    /**
     * You must use named parameters to construct this object.
     *
     * @param list<DocumentType> $documentTypes
     * @param null|list<Process> $processes
     */
    final public function __construct(
        array $documentTypes,
        string $status,
        string $url,
        ?string $error = null,
        ?array $processes = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->documentTypes = $documentTypes;
        $this->status = $status;
        $this->url = $url;

        null !== $error && $this->error = $error;
        null !== $processes && $this->processes = $processes;
    }
}
