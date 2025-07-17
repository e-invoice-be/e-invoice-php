<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\MapOf;
use EInvoiceAPI\Core\Serde\UnionOf;

final class Certificate implements BaseModel
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
     * You must use named parameters to construct this object.
     *
     * @param null|array<string, mixed> $details
     */
    final public function __construct(
        string $status,
        ?array $details = null,
        ?string $error = null
    ) {
        $this->status = $status;
        $this->details = $details;
        $this->error = $error;
    }
}

Certificate::__introspect();
