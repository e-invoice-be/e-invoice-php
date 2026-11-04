<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Mailbox\InboundEmailResponse;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class DocumentsNumberPageTest extends TestCase
{
    /** @var list<RequestInterface> */
    private array $requests = [];

    /** @var list<array<string,mixed>> */
    private array $bodies = [];

    #[Test]
    public function testItemsAreCoercedToTheRequestedItemType(): void
    {
        $documents = $this->client([['items' => [['id' => 'doc_1']], 'page' => 1, 'pages' => 1]])
            ->inbox
            ->list(requestOptions: $this->options())
        ;
        $emails = $this->client([['items' => [['id' => 'mail_1']], 'page' => 1, 'pages' => 1]])
            ->mailbox
            ->list(requestOptions: $this->options())
        ;

        $this->assertInstanceOf(DocumentResponse::class, $documents->getItems()[0]);
        $this->assertSame('doc_1', $documents->getItems()[0]->id);
        $this->assertInstanceOf(InboundEmailResponse::class, $emails->getItems()[0]);
        $this->assertSame('mail_1', $emails->getItems()[0]->id);
    }

    #[Test]
    public function testPagingRequestsEachPageOnce(): void
    {
        $page = $this->client([
            ['items' => [['id' => 'doc_1'], ['id' => 'doc_2']], 'total' => 3, 'page' => 1, 'page_size' => 2, 'pages' => 2, 'has_next_page' => true],
            ['items' => [['id' => 'doc_3']], 'total' => 3, 'page' => 2, 'page_size' => 2, 'pages' => 2, 'has_next_page' => false],
        ])->inbox->list(pageSize: 2, search: 'acme', requestOptions: $this->options());

        $ids = [];
        foreach ($page->pagingEachItem() as $item) {
            $this->assertInstanceOf(DocumentResponse::class, $item);
            $ids[] = $item->id;
        }

        $this->assertSame(['doc_1', 'doc_2', 'doc_3'], $ids);
        $this->assertCount(2, $this->requests);

        parse_str($this->requests[0]->getUri()->getQuery(), $first);
        parse_str($this->requests[1]->getUri()->getQuery(), $second);
        $this->assertSame('1', $first['page'] ?? null);
        $this->assertSame('acme', $first['search'] ?? null);
        $this->assertSame([...$first, 'page' => '2'], $second);
    }

    #[Test]
    public function testLastPageHasNoNextPage(): void
    {
        $page = $this->client([
            ['items' => [['id' => 'doc_1']], 'total' => 1, 'page' => 1, 'page_size' => 20, 'pages' => 1, 'has_next_page' => false],
        ])->inbox->list(requestOptions: $this->options());

        $this->assertFalse($page->hasNextPage());
        $this->assertSame(1, $page->pages);
        $this->assertFalse($page->hasNextPage);
    }

    #[Test]
    public function testPagingWithoutPageMetadataFollowsTheRequestedPage(): void
    {
        $page = $this->client([
            ['items' => [['id' => 'doc_1']]],
            ['items' => [['id' => 'doc_2']]],
            ['items' => []],
        ])->inbox->list(requestOptions: $this->options());

        $ids = [];
        foreach ($page->pagingEachItem() as $item) {
            $ids[] = $item->id;
        }

        $this->assertSame(['doc_1', 'doc_2'], $ids);
        $this->assertSame(['1', '2', '3'], array_map(
            static function (RequestInterface $request): mixed {
                parse_str($request->getUri()->getQuery(), $query);

                return $query['page'] ?? null;
            },
            $this->requests,
        ));
    }

    #[Test]
    public function testExtraQueryParamsAreSentTheSameOnEachPage(): void
    {
        $page = $this->client([
            ['items' => [['id' => 'doc_1']], 'page' => 1, 'pages' => 3],
            ['items' => [['id' => 'doc_2']], 'page' => 2, 'pages' => 3],
            ['items' => [['id' => 'doc_3']], 'page' => 3, 'pages' => 3],
        ])->inbox->list(
            search: 'acme',
            requestOptions: $this->options()->withExtraQueryParams(['page_size' => 5, 'extra' => 'yes']),
        );

        $this->assertCount(3, iterator_to_array($page->pagingEachItem(), preserve_keys: false));
        $this->assertCount(3, $this->requests);

        parse_str($this->requests[0]->getUri()->getQuery(), $first);
        parse_str($this->requests[1]->getUri()->getQuery(), $second);
        parse_str($this->requests[2]->getUri()->getQuery(), $third);
        $this->assertSame(['20', '5'], $first['page_size'] ?? null);
        $this->assertSame('yes', $first['extra'] ?? null);
        $this->assertSame([...$first, 'page' => '2'], $second);
        $this->assertSame([...$first, 'page' => '3'], $third);
    }

    #[Test]
    public function testNextPageOfTheLastPageThrows(): void
    {
        $page = $this->client([
            ['items' => [['id' => 'doc_1']], 'page' => 1, 'pages' => 1, 'has_next_page' => false],
        ])->inbox->list(requestOptions: $this->options());

        $this->assertSame([$page], iterator_to_array($page, preserve_keys: false));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('No next page expected');

        $page->getNextPage();
    }

    /**
     * @param list<array<string,mixed>> $bodies
     */
    private function client(array $bodies): Client
    {
        $this->bodies = $bodies;

        return new Client(apiKey: 'My API Key', baseUrl: 'http://localhost');
    }

    private function options(): RequestOptions
    {
        $record = function (RequestInterface $request): void {
            $this->requests[] = $request;
        };
        $transporter = new class($this->bodies, $record) implements ClientInterface {
            /**
             * @param list<array<string,mixed>> $bodies
             * @param \Closure(RequestInterface): void $record
             */
            public function __construct(private array $bodies, private \Closure $record) {}

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                ($this->record)($request);
                $body = array_shift($this->bodies) ?? ['items' => []];

                return new Response(200, ['Content-Type' => 'application/json'], json_encode($body) ?: '');
            }
        };

        return RequestOptions::with(transporter: $transporter);
    }
}
