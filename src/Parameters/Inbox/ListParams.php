<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class ListParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?\DateTimeInterface $dateFrom;

    #[Api(optional: true)]
    public ?\DateTimeInterface $dateTo;

    #[Api(optional: true)]
    public ?int $page = 1;

    #[Api(optional: true)]
    public ?int $pageSize = 20;

    #[Api(optional: true)]
    public ?string $search;

    #[Api(optional: true)]
    public ?string $sender;

    #[Api(optional: true)]
    public ?string $state;

    #[Api(optional: true)]
    public ?string $type;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        ?string $sender = null,
        ?string $state = null,
        ?string $type = null,
    ) {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->search = $search;
        $this->sender = $sender;
        $this->state = $state;
        $this->type = $type;
    }
}

ListParams::_loadMetadata();
