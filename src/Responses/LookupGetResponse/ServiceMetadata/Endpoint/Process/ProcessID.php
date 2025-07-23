<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Identifier of the process.
 *
 * @phpstan-type process_id_alias = array{scheme: string, value: string}
 */
final class ProcessID implements BaseModel
{
    use Model;

    /**
     * Scheme of the process identifier.
     */
    #[Api]
    public string $scheme;

    /**
     * Value of the process identifier.
     */
    #[Api]
    public string $value;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $scheme, string $value)
    {
        self::introspect();

        $this->scheme = $scheme;
        $this->value = $value;
    }
}
