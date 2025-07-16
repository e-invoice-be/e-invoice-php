<?php

namespace EInvoiceAPI\Core\Pagination;

use EInvoiceAPI\Core\BaseClient;
use Psr\Http\Message\ResponseInterface;

/**
 * @template TItem
 *
 * @extends AbstractPage<TItem>
 */
final class DocumentsNumberPage extends AbstractPage
{
    /** @var list<TItem> */
    public array $items;

    public ?int $page;

    public ?int $pageSize;

    public ?int $total;

    /**
     * @param array{items?: list<TItem>, page?: int, pageSize?: int, total?: int} $body
     */
    public function __construct(
        protected BaseClient $client,
        protected PageRequestOptions $options,
        protected ResponseInterface $response,
        protected mixed $body,
    ) {
        $this->items = $body['items'] ?? [];
        $this->page = $body['page'] ?? 0;
        $this->pageSize = $body['pageSize'] ?? 0;
        $this->total = $body['total'] ?? 0;
    }

    public function nextPageRequestOptions(): ?PageRequestOptions
    {
        $currentPage = $this->page ?? 1;

        return $this->options->withQuery('page', $currentPage + 1);
    }

    /** @return list<TItem> */
    public function getPaginatedItems(): array
    {
        return $this->items;
    }
}
