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
 *   items: list<DocumentResponseShape>,
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
     *   items: ..., page: ..., pageSize: ..., pages: ..., total: ...
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
     * @param list<DocumentResponseShape> $items
     */
    public static function with(
        array $items,
        int $page,
        int $pageSize,
        int $pages,
        int $total
    ): self {
        $self = new self;

        $self['items'] = $items;
        $self['page'] = $page;
        $self['pageSize'] = $pageSize;
        $self['pages'] = $pages;
        $self['total'] = $total;

        return $self;
    }

    /**
     * @param list<DocumentResponseShape> $items
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
