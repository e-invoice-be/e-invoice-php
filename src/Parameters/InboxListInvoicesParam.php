<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class InboxListInvoicesParam implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?int $page;

    #[Api(optional: true)]
    public ?int $pageSize;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(?int $page = null, ?int $pageSize = null)
    {
        self::introspect();
        $this->unsetOptionalProperties();

        null !== $page && $this->page = $page;
        null !== $pageSize && $this->pageSize = $pageSize;
    }
}
