<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process\Endpoint;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process\ProcessID;

/**
 * Process information in the Peppol network.
 */
final class Process implements BaseModel
{
    use SdkModel;

    /**
     * List of endpoints supporting this process.
     *
     * @var list<Endpoint> $endpoints
     */
    #[Api(list: Endpoint::class)]
    public array $endpoints;

    /**
     * Identifier of the process.
     */
    #[Api('processId')]
    public ProcessID $processID;

    /**
     * `new Process()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Process::with(endpoints: ..., processID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Process)->withEndpoints(...)->withProcessID(...)
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
     * @param list<Endpoint> $endpoints
     */
    public static function with(array $endpoints, ProcessID $processID): self
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
    public function withEndpoints(array $endpoints): self
    {
        $obj = clone $this;
        $obj->endpoints = $endpoints;

        return $obj;
    }

    /**
     * Identifier of the process.
     */
    public function withProcessID(ProcessID $processID): self
    {
        $obj = clone $this;
        $obj->processID = $processID;

        return $obj;
    }
}
