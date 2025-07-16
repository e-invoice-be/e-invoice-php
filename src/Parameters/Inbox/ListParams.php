<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|\DateTimeInterface $dateFrom
     * @param null|\DateTimeInterface $dateTo
     * @param null|int                $page
     * @param null|int                $pageSize
     * @param null|string             $search
     * @param null|string             $sender
     * @param string                  $state
     * @param string                  $type
     */
    final public function __construct(
        $dateFrom = None::NOT_GIVEN,
        $dateTo = None::NOT_GIVEN,
        $page = None::NOT_GIVEN,
        $pageSize = None::NOT_GIVEN,
        $search = None::NOT_GIVEN,
        $sender = None::NOT_GIVEN,
        $state = None::NOT_GIVEN,
        $type = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

ListParams::_loadMetadata();
