<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\Certificate;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process\Endpoint;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process\ProcessID;

/**
 * Process information in the Peppol network.
 *
 * @phpstan-type ProcessShape = array{
 *   endpoints: list<Endpoint>, processID: ProcessID
 * }
 */
final class Process implements BaseModel
{
    /** @use SdkModel<ProcessShape> */
    use SdkModel;

    /**
     * List of endpoints supporting this process.
     *
     * @var list<Endpoint> $endpoints
     */
    #[Required(list: Endpoint::class)]
    public array $endpoints;

    /**
     * Identifier of the process.
     */
    #[Required('processId')]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Endpoint|array{
     *   address: string,
     *   transportProfile: string,
     *   certificate?: Certificate|null,
     *   serviceActivationDate?: string|null,
     *   serviceDescription?: string|null,
     *   serviceExpirationDate?: string|null,
     *   technicalContactURL?: string|null,
     *   technicalInformationURL?: string|null,
     * }> $endpoints
     * @param ProcessID|array{scheme: string, value: string} $processID
     */
    public static function with(
        array $endpoints,
        ProcessID|array $processID
    ): self {
        $obj = new self;

        $obj['endpoints'] = $endpoints;
        $obj['processID'] = $processID;

        return $obj;
    }

    /**
     * List of endpoints supporting this process.
     *
     * @param list<Endpoint|array{
     *   address: string,
     *   transportProfile: string,
     *   certificate?: Certificate|null,
     *   serviceActivationDate?: string|null,
     *   serviceDescription?: string|null,
     *   serviceExpirationDate?: string|null,
     *   technicalContactURL?: string|null,
     *   technicalInformationURL?: string|null,
     * }> $endpoints
     */
    public function withEndpoints(array $endpoints): self
    {
        $obj = clone $this;
        $obj['endpoints'] = $endpoints;

        return $obj;
    }

    /**
     * Identifier of the process.
     *
     * @param ProcessID|array{scheme: string, value: string} $processID
     */
    public function withProcessID(ProcessID|array $processID): self
    {
        $obj = clone $this;
        $obj['processID'] = $processID;

        return $obj;
    }
}
