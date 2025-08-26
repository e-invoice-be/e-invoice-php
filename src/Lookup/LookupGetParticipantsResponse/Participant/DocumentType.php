<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Represents a supported document type.
 */
final class DocumentType implements BaseModel
{
    use SdkModel;

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
     * `new DocumentType()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentType::with(scheme: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentType)->withScheme(...)->withValue(...)
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
     * Document type scheme.
     */
    public function withScheme(string $scheme): self
    {
        $obj = clone $this;
        $obj->scheme = $scheme;

        return $obj;
    }

    /**
     * Document type value.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
