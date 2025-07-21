<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type document_type_alias = array{scheme: string, value: string}
 */
final class DocumentType implements BaseModel
{
    use Model;

    #[Api]
    public string $scheme;

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
