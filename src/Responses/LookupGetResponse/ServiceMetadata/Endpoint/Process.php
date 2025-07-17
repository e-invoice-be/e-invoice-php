<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\Process\Endpoint;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\Process\ProcessID;

final class Process implements BaseModel
{
    use Model;

    /** @var list<Endpoint> $endpoints */
    #[Api(type: new ListOf(Endpoint::class))]
    public array $endpoints;

    #[Api('processId')]
    public ProcessID $processID;

    /**
     * You must use named parameters to construct this object.
     *
     * @param list<Endpoint> $endpoints
     */
    final public function __construct(array $endpoints, ProcessID $processID)
    {
        $this->endpoints = $endpoints;
        $this->processID = $processID;

        self::_introspect();
    }
}
