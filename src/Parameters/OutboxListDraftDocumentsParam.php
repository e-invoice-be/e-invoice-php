<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class OutboxListDraftDocumentsParam implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?int $page = 1;

    #[Api(optional: true)]
    public ?int $pageSize = 20;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(?int $page = null, ?int $pageSize = null)
    {
        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $page && $this->page = $page;
        null !== $pageSize && $this->pageSize = $pageSize;
    }
}
