<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Identifier of the process.
 *
 * @phpstan-type process_id_alias = array{scheme: string, value: string}
 */
final class ProcessID implements BaseModel
{
    use Model;

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
     * Scheme of the process identifier.
     */
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * Value of the process identifier.
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
