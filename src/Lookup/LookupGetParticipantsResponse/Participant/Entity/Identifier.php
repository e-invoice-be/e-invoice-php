<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Represents a business identifier.
 *
 * @phpstan-type IdentifierShape = array{scheme: string, value: string}
 */
final class Identifier implements BaseModel
{
    /** @use SdkModel<IdentifierShape> */
    use SdkModel;

    /**
     * Identifier scheme.
     */
    #[Required]
    public string $scheme;

    /**
     * Identifier value.
     */
    #[Required]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $scheme, string $value): self
    {
        $self = new self;

        $self['scheme'] = $scheme;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Identifier scheme.
     */
    public function withScheme(string $scheme): self
    {
        $self = clone $this;
        $self['scheme'] = $scheme;

        return $self;
    }

    /**
     * Identifier value.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
