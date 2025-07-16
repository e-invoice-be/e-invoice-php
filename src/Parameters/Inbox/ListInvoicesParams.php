<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

final class ListInvoicesParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?int $page = 1;

    #[Api(optional: true)]
    public ?int $pageSize = 20;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|int $page
     * @param null|int $pageSize
     */
    final public function __construct(
        $page = None::NOT_GIVEN,
        $pageSize = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

ListInvoicesParams::_loadMetadata();
