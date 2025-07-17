<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant\Entity;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class Identifier implements BaseModel
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
        $this->scheme = $scheme;
        $this->value = $value;

        self::_introspect();
    }
}
