<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process\Endpoint;
use EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process\ProcessID;

/**
 * Process information in the Peppol network.
 *
 * @phpstan-type process_alias = array{
 *   endpoints: list<Endpoint>, processID: ProcessID
 * }
 */
final class Process implements BaseModel
{
    use Model;

    /**
     * List of endpoints supporting this process.
     *
     * @var list<Endpoint> $endpoints
     */
    #[Api(type: new ListOf(Endpoint::class))]
    public array $endpoints;

    /**
     * Identifier of the process.
     */
    #[Api('processId')]
    public ProcessID $processID;

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
    public static function from(array $endpoints, ProcessID $processID): self
    {
        $obj = new self;

        $obj->endpoints = $endpoints;
        $obj->processID = $processID;

        return $obj;
    }

    /**
     * List of endpoints supporting this process.
     *
     * @param list<Endpoint> $endpoints
     */
    public function setEndpoints(array $endpoints): self
    {
        $this->endpoints = $endpoints;

        return $this;
    }

    /**
     * Identifier of the process.
     */
    public function setProcessID(ProcessID $processID): self
    {
        $this->processID = $processID;

        return $this;
    }
}
