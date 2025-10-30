<?php

namespace EInvoiceAPI;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkPage;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Contracts\BasePage;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\DocumentsNumberPage\Item;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type DocumentsNumberPageShape = array{
 *   items?: list<Item>|null,
 *   page?: int|null,
 *   pageSize?: int|null,
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
    #[Api(list: Item::class, optional: true)]
    public ?array $items;

    #[Api(optional: true)]
    public ?int $page;

    #[Api('page_size', optional: true)]
    public ?int $pageSize;

    #[Api(optional: true)]
    public ?int $total;

    /**
     * @internal
     *
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
        ResponseInterface $response,
    ) {
        $this->initialize();

        $data = Util::decodeContent($response);

        if (!is_array($data)) {
            return;
        }

        // @phpstan-ignore-next-line
        self::__unserialize($data);

        if ($this->offsetExists('items')) {
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
        // @phpstan-ignore-next-line
        return $this->offsetGet('items') ?? [];
    }

    /**
     * @internal
     *
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
