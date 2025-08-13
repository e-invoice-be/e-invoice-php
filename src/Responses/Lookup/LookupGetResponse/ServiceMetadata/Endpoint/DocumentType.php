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
    public static function from(string $scheme, string $value): self
    {
        $obj = new self;

        $obj->scheme = $scheme;
        $obj->value = $value;

        return $obj;
    }

    /**
     * Scheme of the document type identifier.
     */
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * Value of the document type identifier.
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
