<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Identifier of the process.
 */
final class ProcessID implements BaseModel
{
    use SdkModel;

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
     * Scheme of the process identifier.
     */
    public function withScheme(string $scheme): self
    {
        $obj = clone $this;
        $obj->scheme = $scheme;

        return $obj;
    }

    /**
     * Value of the process identifier.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
