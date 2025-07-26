<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Represents a supported document type.
 *
 * @phpstan-type document_type_alias = array{scheme: string, value: string}
 */
final class DocumentType implements BaseModel
{
    use Model;

    /**
     * Document type scheme.
     */
    #[Api]
    public string $scheme;

    /**
     * Document type value.
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
    public static function new(string $scheme, string $value): self
    {
        $obj = new self;

        $obj->scheme = $scheme;
        $obj->value = $value;

        return $obj;
    }

    /**
     * Document type scheme.
     */
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * Document type value.
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
