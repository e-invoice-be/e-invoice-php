<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Certificate information for a Peppol endpoint.
 *
 * @phpstan-type CertificateShape = array{
 *   status: string, details?: array<string,mixed>|null, error?: string|null
 * }
 */
final class Certificate implements BaseModel
{
    /** @use SdkModel<CertificateShape> */
    use SdkModel;

    /**
     * Status of the certificate validation: 'success', 'error', or 'pending'.
     */
    #[Required]
    public string $status;

    /**
     * Details about the certificate including subject, issuer, validity dates, etc.
     *
     * @var array<string,mixed>|null $details
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $details;

    /**
     * Error message if certificate validation failed.
     */
    #[Optional(nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $details
     */
    public static function with(
        string $status,
        ?array $details = null,
        ?string $error = null
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $details && $self['details'] = $details;
        null !== $error && $self['error'] = $error;

        return $self;
    }

    /**
     * Status of the certificate validation: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Details about the certificate including subject, issuer, validity dates, etc.
     *
     * @param array<string,mixed>|null $details
     */
    public function withDetails(?array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }

    /**
     * Error message if certificate validation failed.
     */
    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
