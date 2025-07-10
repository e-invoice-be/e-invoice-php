<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

class PaginatedDocumentResponse implements BaseModel
{
    use Model;

    /** @var list<DocumentResponse> $items */
    #[Api(type: new ListOf(DocumentResponse::class))]
    public array $items;

    #[Api]
    public int $page;

    #[Api('page_size')]
    public int $pageSize;

    #[Api]
    public int $pages;

    #[Api]
    public int $total;

    /**
     * @param list<DocumentResponse> $items
     * @param int                    $page
     * @param int                    $pageSize
     * @param int                    $pages
     * @param int                    $total
     */
    final public function __construct($items, $page, $pageSize, $pages, $total)
    {
        $this->constructFromArgs(func_get_args());
    }
}

PaginatedDocumentResponse::_loadMetadata();
