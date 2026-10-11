<?php

namespace EInvoiceAPI;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkPage;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Contracts\BasePage;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;
use EInvoiceAPI\Core\Conversion\ListOf;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type DocumentsNumberPageShape = array{
 *   items?: list<mixed>|null,
 *   hasNextPage?: bool|null,
 *   page?: int|null,
 *   pageSize?: int|null,
 *   pages?: int|null,
 *   total?: int|null,
 * }
 *
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class DocumentsNumberPage implements BaseModel, BasePage
{
    /** @use SdkModel<DocumentsNumberPageShape> */
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $items */
    #[Optional(list: 'mixed')]
    public ?array $items;

    #[Optional('has_next_page')]
    public ?bool $hasNextPage;

    #[Optional]
    public ?int $page;

    #[Optional('page_size')]
    public ?int $pageSize;

    #[Optional]
    public ?int $pages;

    #[Optional]
    public ?int $total;

    /**
     * @internal
     *
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string,mixed>,
     *   headers: array<string,string|list<string>|null>,
     *   body: mixed,
     * } $requestInfo
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $requestInfo,
        private RequestOptions $options,
        private ResponseInterface $response,
        private mixed $parsedBody,
    ) {
        $this->initialize();

        if (!is_array($this->parsedBody)) {
            return;
        }

        $data = $this->parsedBody;
        foreach (self::$converter->properties as $name => $info) {
            if ($name !== $info->apiName && array_key_exists($info->apiName, array: $data)) {
                $data[$name] = $data[$info->apiName];
                unset($data[$info->apiName]);
            }
        }

        // @phpstan-ignore-next-line argument.type
        self::__unserialize($data);

        if ($this->offsetGet('items')) {
            $acc = Conversion::coerce(
                new ListOf($convert),
                value: $this->offsetGet('items')
            );
            // @phpstan-ignore-next-line
            $this->offsetSet('items', $acc);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line return.type
        return $this->offsetGet('items') ?? [];
    }

    /**
     * @internal
     *
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string,mixed>,
     *     headers: array<string,string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        /** @var int */
        $curr = $this->page ?? $this->requestInfo['query']['page'] ?? 1;
        if (!count($this->getItems()) || false === ($this->hasNextPage ?? null) || ($curr >= ($this->pages ?? PHP_INT_MAX))) {
            return null;
        }

        [$path] = explode('?', $this->requestInfo['path'], limit: 2);
        $nextRequest = [
            ...$this->requestInfo,
            'path' => $path,
            'query' => [...$this->requestInfo['query'], 'page' => $curr + 1],
        ];

        // @phpstan-ignore-next-line return.type
        return [$nextRequest, $this->options->withExtraQueryParams([])];
    }
}
