<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Represents a supported document type.
 *
 * @phpstan-type document_type_alias = array{scheme: string, value: string}
 */
final class DocumentType implements BaseModel
{
    use Model;

    /**
     * Document type scheme.
     */
    #[Api]
    public string $scheme;

    /**
     * Document type value.
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
