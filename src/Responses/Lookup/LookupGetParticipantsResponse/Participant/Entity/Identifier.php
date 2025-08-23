<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse\Participant\Entity;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Represents a business identifier.
 */
final class Identifier implements BaseModel
{
    use SdkModel;

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
     * `new Identifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Identifier::with(scheme: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Identifier)->withScheme(...)->withValue(...)
     * ```
     */
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
    public static function with(string $scheme, string $value): self
    {
        $obj = new self;

        $obj->scheme = $scheme;
        $obj->value = $value;

        return $obj;
    }

    /**
     * Identifier scheme.
     */
    public function withScheme(string $scheme): self
    {
        $obj = clone $this;
        $obj->scheme = $scheme;

        return $obj;
    }

    /**
     * Identifier value.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
