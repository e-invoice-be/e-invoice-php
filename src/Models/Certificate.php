<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\MapOf;

/**
 * Certificate information for a Peppol endpoint.
 *
 * @phpstan-type certificate_alias = array{
 *   status: string, details?: array<string, mixed>|null, error?: string|null
 * }
 */
final class Certificate implements BaseModel
{
    use Model;

    /**
     * Status of the certificate validation: 'success', 'error', or 'pending'.
     */
    #[Api]
    public string $status;

    /**
     * Details about the certificate including subject, issuer, validity dates, etc.
     *
     * @var null|array<string, mixed> $details
     */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $details;

    /**
     * Error message if certificate validation failed.
     */
    #[Api(optional: true)]
    public ?string $error;

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
     * @param null|array<string, mixed> $details
     */
    public static function new(
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
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Details about the certificate including subject, issuer, validity dates, etc.
     *
     * @param null|array<string, mixed> $details
     */
    public function setDetails(?array $details): self
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Error message if certificate validation failed.
     */
    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }
}
