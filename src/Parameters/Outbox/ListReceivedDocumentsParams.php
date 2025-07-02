<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Outbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

class ListReceivedDocumentsParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * @var null|mixed $dateFrom
     */
    #[Api(optional: true)]
    public mixed $dateFrom;

    /**
     * @var null|mixed $dateTo
     */
    #[Api(optional: true)]
    public mixed $dateTo;

    #[Api(optional: true)]
    public int $page;

    #[Api(optional: true)]
    public int $pageSize;

    #[Api(optional: true)]
    public ?string $search;

    #[Api(optional: true)]
    public ?string $sender;

    #[Api(optional: true)]
    public string $state;

    #[Api(optional: true)]
    public string $type;
}

ListReceivedDocumentsParams::_loadMetadata();
