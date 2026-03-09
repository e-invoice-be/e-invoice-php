<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentResponse;

/**
 * @phpstan-import-type DocumentResponseShape from \EInvoiceAPI\Documents\DocumentResponse
 *
 * @phpstan-type PaginatedDocumentResponseShape = array{
 *   hasNextPage: bool,
 *   items: list<DocumentResponse|DocumentResponseShape>,
 *   page: int,
 *   pageSize: int,
 *   pages: int,
 *   total: int,
 * }
 */
final class PaginatedDocumentResponse implements BaseModel
{
    /** @use SdkModel<PaginatedDocumentResponseShape> */
    use SdkModel;

    #[Required('has_next_page')]
    public bool $hasNextPage;

    /** @var list<DocumentResponse> $items */
    #[Required(list: DocumentResponse::class)]
    public array $items;

    #[Required]
    public int $page;

    #[Required('page_size')]
    public int $pageSize;

    #[Required]
    public int $pages;

    #[Required]
    public int $total;

    /**
     * `new PaginatedDocumentResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaginatedDocumentResponse::with(
     *   hasNextPage: ..., items: ..., page: ..., pageSize: ..., pages: ..., total: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaginatedDocumentResponse)
     *   ->withHasNextPage(...)
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
     * @param list<DocumentResponse|DocumentResponseShape> $items
     */
    public static function with(
        bool $hasNextPage,
        array $items,
        int $page,
        int $pageSize,
        int $pages,
        int $total,
    ): self {
        $self = new self;

        $self['hasNextPage'] = $hasNextPage;
        $self['items'] = $items;
        $self['page'] = $page;
        $self['pageSize'] = $pageSize;
        $self['pages'] = $pages;
        $self['total'] = $total;

        return $self;
    }

    public function withHasNextPage(bool $hasNextPage): self
    {
        $self = clone $this;
        $self['hasNextPage'] = $hasNextPage;

        return $self;
    }

    /**
     * @param list<DocumentResponse|DocumentResponseShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    public function withPages(int $pages): self
    {
        $self = clone $this;
        $self['pages'] = $pages;

        return $self;
    }

    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
