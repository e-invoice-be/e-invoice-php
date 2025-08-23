<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\MapOf;

/**
 * Certificate information for a Peppol endpoint.
 */
final class Certificate implements BaseModel
{
    use SdkModel;

    /**
     * Status of the certificate validation: 'success', 'error', or 'pending'.
     */
    #[Api]
    public string $status;

    /**
     * Details about the certificate including subject, issuer, validity dates, etc.
     *
     * @var array<string, mixed>|null $details
     */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $details;

    /**
     * Error message if certificate validation failed.
     */
    #[Api(optional: true)]
    public ?string $error;

    /**
     * `new Certificate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Certificate::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Certificate)->withStatus(...)
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
     *
     * @param array<string, mixed>|null $details
     */
    public static function with(
        string $status,
        ?array $details = null,
        ?string $error = null
    ): self {
        $obj = new self;

        $obj->status = $status;

        null !== $details && $obj->details = $details;
        null !== $error && $obj->error = $error;

        return $obj;
    }

    /**
     * Status of the certificate validation: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * Details about the certificate including subject, issuer, validity dates, etc.
     *
     * @param array<string, mixed>|null $details
     */
    public function withDetails(?array $details): self
    {
        $obj = clone $this;
        $obj->details = $details;

        return $obj;
    }

    /**
     * Error message if certificate validation failed.
     */
    public function withError(?string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }
}
