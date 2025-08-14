<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Document type supported by a Peppol participant.
 *
 * @phpstan-type document_type_alias = array{scheme: string, value: string}
 */
final class DocumentType implements BaseModel
{
    use Model;

    /**
     * Scheme of the document type identifier.
     */
    #[Api]
    public string $scheme;

    /**
     * Value of the document type identifier.
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
     * Scheme of the document type identifier.
     */
    public function withScheme(string $scheme): self
    {
        $obj = clone $this;
        $obj->scheme = $scheme;

        return $obj;
    }

    /**
     * Value of the document type identifier.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
