<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class ListInvoicesParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public int $page;

    #[Api(optional: true)]
    public int $pageSize;
}

ListInvoicesParams::_loadMetadata();
