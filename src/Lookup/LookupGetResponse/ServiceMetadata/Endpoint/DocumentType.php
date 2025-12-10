<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Document type supported by a Peppol participant.
 *
 * @phpstan-type DocumentTypeShape = array{scheme: string, value: string}
 */
final class DocumentType implements BaseModel
{
    /** @use SdkModel<DocumentTypeShape> */
    use SdkModel;

    /**
     * Scheme of the document type identifier.
     */
    #[Required]
    public string $scheme;

    /**
     * Value of the document type identifier.
     */
    #[Required]
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
     * Scheme of the document type identifier.
     */
    public function withScheme(string $scheme): self
    {
        $self = clone $this;
        $self['scheme'] = $scheme;

        return $self;
    }

    /**
     * Value of the document type identifier.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
