<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\MapOf;

final class Certificate implements BaseModel
{
    use Model;

    #[Api]
    public string $status;

    /** @var null|array<string, mixed> $details */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();

        $this->status = $status;

        null !== $details && $this->details = $details;
        null !== $error && $this->error = $error;
    }
}
