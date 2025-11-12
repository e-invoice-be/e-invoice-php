<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentResponse;

/**
 * @phpstan-type PaginatedDocumentResponseShape = array{
 *   items: list<DocumentResponse>,
 *   page: int,
 *   page_size: int,
 *   pages: int,
 *   total: int,
 * }
 */
final class PaginatedDocumentResponse implements BaseModel
{
    /** @use SdkModel<PaginatedDocumentResponseShape> */
    use SdkModel;

    /** @var list<DocumentResponse> $items */
    #[Api(list: DocumentResponse::class)]
    public array $items;

    #[Api]
    public int $page;

    #[Api]
    public int $page_size;

    #[Api]
    public int $pages;

    #[Api]
    public int $total;

    /**
     * `new PaginatedDocumentResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaginatedDocumentResponse::with(
     *   items: ..., page: ..., page_size: ..., pages: ..., total: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaginatedDocumentResponse)
     *   ->withItems(...)
     *   ->withPage(...)
     *   ->withPageSize(...)
     *   ->withPages(...)
     *   ->withTotal(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DocumentResponse> $items
     */
    public static function with(
        array $items,
        int $page,
        int $page_size,
        int $pages,
        int $total
    ): self {
        $obj = new self;

        $obj->items = $items;
        $obj->page = $page;
        $obj->page_size = $page_size;
        $obj->pages = $pages;
        $obj->total = $total;

        return $obj;
    }

    /**
     * @param list<DocumentResponse> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    public function withPage(int $page): self
    {
        $obj = clone $this;
        $obj->page = $page;

        return $obj;
    }

    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }

    public function withPages(int $pages): self
    {
        $obj = clone $this;
        $obj->pages = $pages;

        return $obj;
    }

    public function withTotal(int $total): self
    {
        $obj = clone $this;
        $obj->total = $total;

        return $obj;
    }
}
