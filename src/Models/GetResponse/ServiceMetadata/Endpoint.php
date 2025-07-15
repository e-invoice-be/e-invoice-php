<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse\ServiceMetadata;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Core\Serde\UnionOf;
use EInvoiceAPI\Models\GetResponse\ServiceMetadata\Endpoint\DocumentType;
use EInvoiceAPI\Models\GetResponse\ServiceMetadata\Endpoint\Process;

class Endpoint implements BaseModel
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
    #[Api(
        type: new UnionOf([new ListOf(Process::class), 'null']),
        optional: true
    )]
    public ?array $processes;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param list<DocumentType> $documentTypes `required`
     * @param string             $status        `required`
     * @param string             $url           `required`
     * @param null|string        $error
     * @param null|list<Process> $processes
     */
    final public function __construct(
        $documentTypes,
        $status,
        $url,
        $error = None::NOT_GIVEN,
        $processes = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Endpoint::_loadMetadata();
