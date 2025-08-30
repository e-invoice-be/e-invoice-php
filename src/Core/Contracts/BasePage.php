<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;
use EInvoiceAPI\RequestOptions;

/**
 * @internal
 *
 * @phpstan-import-type normalized_request from \EInvoiceAPI\Core\BaseClient
 *
 * @template Item
 *
 * @extends \IteratorAggregate<int, static>
 */
interface BasePage extends \IteratorAggregate
{
    /**
     * @internal
     *
     * @param normalized_request $request
     */
    public function __construct(
        Converter|ConverterSource|string $convert,
        Client $client,
        array $request,
        RequestOptions $options,
        mixed $data,
    );

    public function hasNextPage(): bool;

    /**
     * @return list<Item>
     */
    public function getItems(): array;

    /**
     * @return static<Item>
     */
    public function getNextPage(): static;

    /**
     * @return \Generator<Item>
     */
    public function pagingEachItem(): \Generator;
}
