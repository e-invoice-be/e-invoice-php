<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetResponse\ServiceMetadata\Endpoint\Process\Endpoint;
use EInvoiceAPI\Models\GetResponse\ServiceMetadata\Endpoint\Process\ProcessID;

final class Process implements BaseModel
{
    use Model;

    /** @var list<Endpoint> $endpoints */
    #[Api(type: new ListOf(Endpoint::class))]
    public array $endpoints;

    #[Api('processId')]
    public ProcessID $processID;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param list<Endpoint> $endpoints `required`
     * @param ProcessID      $processID `required`
     */
    final public function __construct($endpoints, $processID)
    {
        $this->constructFromArgs(func_get_args());
    }
}

Process::_loadMetadata();
