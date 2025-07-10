<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class ListParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?\DateTimeInterface $dateFrom;

    #[Api(optional: true)]
    public ?\DateTimeInterface $dateTo;

    #[Api(optional: true)]
    public ?int $page;

    #[Api(optional: true)]
    public ?int $pageSize;

    #[Api(optional: true)]
    public ?string $search;

    #[Api(optional: true)]
    public ?string $sender;

    #[Api(optional: true)]
    public string $state;

    #[Api(optional: true)]
    public string $type;
}

ListParams::_loadMetadata();
