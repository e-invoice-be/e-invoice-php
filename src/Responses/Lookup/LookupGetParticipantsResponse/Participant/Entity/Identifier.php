<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse\Participant\Entity;

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

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(string $scheme, string $value): self
    {
        $obj = new self;

        $obj->scheme = $scheme;
        $obj->value = $value;

        return $obj;
    }

    /**
     * Identifier scheme.
     */
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * Identifier value.
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
