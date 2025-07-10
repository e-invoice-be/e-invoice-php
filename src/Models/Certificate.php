<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\MapOf;
use EInvoiceAPI\Core\Serde\UnionOf;

class Certificate implements BaseModel
{
    use Model;

    #[Api]
    public string $status;

    /** @var null|array<string, mixed> $details */
    #[Api(type: new UnionOf([new MapOf('mixed'), 'null']), optional: true)]
    public ?array $details;

    #[Api(optional: true)]
    public ?string $error;

    /**
     * @param string                    $status
     * @param null|array<string, mixed> $details
     * @param null|string               $error
     */
    final public function __construct(
        $status,
        $details = None::NOT_GIVEN,
        $error = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Certificate::_loadMetadata();
