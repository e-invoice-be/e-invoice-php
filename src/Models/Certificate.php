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

    /**
     * You must use named parameters to construct this object.
     *
     * @param null|array<string, mixed> $details
     */
    final public function __construct(
        string $status,
        ?array $details = null,
        ?string $error = null
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->status = $status;

        null !== $details && $this->details = $details;
        null !== $error && $this->error = $error;
    }
}
