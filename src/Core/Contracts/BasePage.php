<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

use EInvoiceAPI\Core\BaseClient;
use EInvoiceAPI\Core\Pagination\PageRequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @template Item
 *
 * @extends \IteratorAggregate<int, static>
 */
interface BasePage extends \IteratorAggregate
{
    /**
     * @internal
     */
    public function __construct(
        BaseClient $client,
        PageRequestOptions $options,
        ResponseInterface $response,
        mixed $body,
    );

    public function hasNextPage(): bool;

    /**
     * @return list<Item>
     */
    public function getPaginatedItems(): array;

    /**
     * @return static<Item>
     */
    public function getNextPage(): static;
}
