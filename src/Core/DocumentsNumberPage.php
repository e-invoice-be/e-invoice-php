<?php

namespace EInvoiceAPI\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkPage;
use EInvoiceAPI\Core\Contracts\BasePage;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\RequestOptions;

/**
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class DocumentsNumberPage implements BasePage
{
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $items */
    #[Api(list: STAINLESS_FIXME_Item::class, optional: true)]
    public ?array $items;

    #[Api(optional: true)]
    public ?int $page;

    #[Api('page_size', optional: true)]
    public ?int $pageSize;

    #[Api(optional: true)]
    public ?int $total;

    /**
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string, mixed>,
     *   headers: array<string, string|list<string>|null>,
     *   body: mixed,
     * } $request
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $request,
        private RequestOptions $options,
        mixed $data,
    ) {
        self::introspect();

        if (!is_array($data)) {
            return;
        }

        self::__unserialize($data);

        if ($this->offsetExists('items')) {
            $acc = Conversion::coerce(
                new ListOf($convert),
                value: $this->offsetGet('items')
            );
            $this->offsetSet('items', $acc);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line
        return $this->offsetGet('items') ?? [];
    }

    /**
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string, mixed>,
     *     headers: array<string, string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        $currentPage = $this->page ?? 1;
        $nextRequest = $this->request;

        return [$nextRequest, $this->options];
    }
}
