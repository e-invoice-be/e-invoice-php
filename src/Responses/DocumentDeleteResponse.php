<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type document_delete_response_alias = array{isDeleted: bool}
 */
final class DocumentDeleteResponse implements BaseModel
{
    use Model;

    #[Api('is_deleted')]
    public bool $isDeleted;

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
    public static function new(bool $isDeleted): self
    {
        $obj = new self;

        $obj->isDeleted = $isDeleted;

        return $obj;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
