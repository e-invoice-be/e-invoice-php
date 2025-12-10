<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Identifier of the process.
 *
 * @phpstan-type ProcessIDShape = array{scheme: string, value: string}
 */
final class ProcessID implements BaseModel
{
    /** @use SdkModel<ProcessIDShape> */
    use SdkModel;

    /**
     * Scheme of the process identifier.
     */
    #[Required]
    public string $scheme;

    /**
     * Value of the process identifier.
     */
    #[Required]
    public string $value;

    /**
     * `new ProcessID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProcessID::with(scheme: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProcessID)->withScheme(...)->withValue(...)
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
     * Scheme of the process identifier.
     */
    public function withScheme(string $scheme): self
    {
        $self = clone $this;
        $self['scheme'] = $scheme;

        return $self;
    }

    /**
     * Value of the process identifier.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
