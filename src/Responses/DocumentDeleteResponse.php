<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class DocumentDeleteResponse implements BaseModel
{
    use Model;

    #[Api('is_deleted')]
    public bool $isDeleted;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(bool $isDeleted)
    {
        self::introspect();

        $this->isDeleted = $isDeleted;
    }
}
