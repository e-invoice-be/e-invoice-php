<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\DocumentType;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\Process;

final class Endpoint implements BaseModel
{
    use Model;

    /** @var list<DocumentType> $documentTypes */
    #[Api(type: new ListOf(DocumentType::class))]
    public array $documentTypes;

    #[Api]
    public string $status;

    #[Api]
    public string $url;

    #[Api(optional: true)]
    public ?string $error;

    /** @var null|list<Process> $processes */
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
