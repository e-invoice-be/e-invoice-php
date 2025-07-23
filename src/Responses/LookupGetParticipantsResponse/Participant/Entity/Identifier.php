<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant\Entity;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Represents a business identifier.
 *
 * @phpstan-type identifier_alias = array{scheme: string, value: string}
 */
final class Identifier implements BaseModel
{
    use Model;

    /**
     * Identifier scheme.
     */
    #[Api]
    public string $scheme;

    /**
     * Identifier value.
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
