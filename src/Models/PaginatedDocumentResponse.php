<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

final class PaginatedDocumentResponse implements BaseModel
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
     * You must use named parameters to construct this object.
     *
     * @param list<DocumentResponse> $items
     */
    final public function __construct(
        array $items,
        int $page,
        int $pageSize,
        int $pages,
        int $total
    ) {
        $this->items = $items;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->pages = $pages;
        $this->total = $total;
    }
}

PaginatedDocumentResponse::__introspect();
