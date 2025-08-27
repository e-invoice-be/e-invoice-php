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
 * @template Item
 *
 * @extends \ArrayAccess<string, mixed>
 * @extends \IteratorAggregate<int, static>
 */
interface BasePage extends \ArrayAccess, \JsonSerializable, \Stringable, \IteratorAggregate
{
    /**
     * @internal
     *
     * @param array<string, mixed> $request
     */
    public function __construct(
        Converter|ConverterSource|string $convert,
        Client $client,
        array $request,
        RequestOptions $options,
        mixed $data,
    );

    /**
     * @return static<Item>
     */
    public static function fromArray(mixed $data): self;

    /** @return array<string, mixed> */
    public function toArray(): array;

    public function hasNextPage(): bool;

    /**
     * @return list<Item>
     */
    public function getPaginatedItems(): array;

    /**
     * @return static<Item>
     */
    public function getNextPage(): static;

    /**
     * @return \Generator<Item>
     */
    public function pagingEachItem(): \Generator;
}
