<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;

/**
 * @phpstan-type paginated_document_response_alias = array{
 *   items: list<DocumentResponse>,
 *   page: int,
 *   pageSize: int,
 *   pages: int,
 *   total: int,
 * }
 */
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

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DocumentResponse> $items
     */
    public static function new(
        array $items,
        int $page,
        int $pageSize,
        int $pages,
        int $total
    ): self {
        $obj = new self;

        $obj->items = $items;
        $obj->page = $page;
        $obj->pageSize = $pageSize;
        $obj->pages = $pages;
        $obj->total = $total;

        return $obj;
    }

    /**
     * @param list<DocumentResponse> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    public function setPages(int $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }
}
