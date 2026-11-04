<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Webhooks\WebhookResponse;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Support\MockClient;

/**
 * The PSR-7 response of the `raw` services, and how a response body is decoded.
 *
 * @internal
 */
final class RawResponseTest extends TestCase
{
    private Client $client;

    private MockClient $http;

    protected function setUp(): void
    {
        parent::setUp();

        $this->http = new MockClient;
        $this->client = new Client(apiKey: 'k', baseUrl: 'http://localhost');
    }

    #[Test]
    public function testRawResponseExposesTheHttpResponse(): void
    {
        $this->http->queueJson(self::webhook(), 200, ['X-Request-Id' => 'req_1']);

        $response = $this->client->webhooks->raw->retrieve('wh_1', requestOptions: $this->options());

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertSame('1.1', $response->getProtocolVersion());
        $this->assertTrue($response->hasHeader('x-request-id'));
        $this->assertSame(['req_1'], $response->getHeader('X-Request-Id'));
        $this->assertSame('req_1', $response->getHeaderLine('X-Request-Id'));
        $this->assertArrayHasKey('Content-Type', $response->getHeaders());
        $this->assertSame('/api/webhooks/wh_1', $response->getRequest()->getUri()->getPath());
    }

    #[Test]
    public function testParseIsDoneOnce(): void
    {
        $this->http->queueJson(self::webhook());

        $response = $this->client->webhooks->raw->retrieve('wh_1', requestOptions: $this->options());

        $first = $response->parse();
        $this->assertInstanceOf(WebhookResponse::class, $first);
        $this->assertSame('wh_1', $first->id);
        $this->assertSame($first, $response->parse());
    }

    #[Test]
    public function testWithersReturnACopyAndKeepTheOriginal(): void
    {
        $this->http->queueJson(self::webhook());

        $response = $this->client->webhooks->raw->retrieve('wh_1', requestOptions: $this->options());
        $body = (new Psr17Factory)->createStream('other');

        $changed = $response
            ->withStatus(201, 'Created')
            ->withProtocolVersion('2')
            ->withHeader('X-A', 'a')
            ->withAddedHeader('X-A', 'b')
            ->withoutHeader('Content-Type')
            ->withBody($body)
        ;

        $this->assertSame(201, $changed->getStatusCode());
        $this->assertSame('Created', $changed->getReasonPhrase());
        $this->assertSame('2', $changed->getProtocolVersion());
        $this->assertSame(['a', 'b'], $changed->getHeader('X-A'));
        $this->assertFalse($changed->hasHeader('Content-Type'));
        $this->assertSame($body, $changed->getBody());

        $this->assertSame(200, $response->getStatusCode());
        $this->assertFalse($response->hasHeader('X-A'));
        $this->assertTrue($response->hasHeader('Content-Type'));
        $this->assertInstanceOf(WebhookResponse::class, $response->parse());
    }

    #[Test]
    public function testJsonWithCharsetIsDecoded(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], '{"a":1}');

        $this->assertSame(['a' => 1], Util::decodeContent($response));
    }

    #[Test]
    public function testVendorJsonContentTypeIsDecoded(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/vnd.api+json; charset=utf-8'], '{"a":1}');

        $this->assertSame(['a' => 1], Util::decodeContent($response));
    }

    #[Test]
    public function testProblemJsonContentTypeIsDecoded(): void
    {
        $response = new Response(422, ['Content-Type' => 'application/problem+json'], '{"title":"Invalid"}');

        $this->assertSame(['title' => 'Invalid'], Util::decodeContent($response));
    }

    #[Test]
    #[DataProvider('jsonContentTypes')]
    public function testJsonContentTypePattern(string $contentType, bool $matches): void
    {
        $this->assertSame($matches, 1 === preg_match(Util::JSON_CONTENT_TYPE, $contentType));
    }

    /**
     * @return iterable<string, array{string, bool}>
     */
    public static function jsonContentTypes(): iterable
    {
        yield 'json' => ['application/json', true];

        yield 'json with charset' => ['application/json; charset=utf-8', true];

        yield 'vendor json' => ['application/vnd.api+json', true];

        yield 'vendor json with dots' => ['application/vnd.e-invoice.v1+json', true];

        yield 'problem json' => ['application/problem+json', true];

        yield 'json lines' => ['application/jsonl', false];

        yield 'vendor json lines' => ['application/vnd.api+jsonl', false];

        yield 'json without a suffix separator' => ['application/vndjson', false];

        yield 'ndjson' => ['application/x-ndjson', false];

        yield 'text' => ['text/json', false];
    }

    #[Test]
    public function testJsonLinesAreDecodedLineByLine(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/x-ndjson'], "{\"a\":1}\n{\"a\":2}\n{\"a\":3}");

        $decoded = Util::decodeContent($response);

        $this->assertInstanceOf(\Iterator::class, $decoded);
        $this->assertSame([['a' => 1], ['a' => 2], ['a' => 3]], iterator_to_array($decoded, preserve_keys: false));
    }

    #[Test]
    public function testOtherContentIsStreamedInChunks(): void
    {
        $content = str_repeat('x', Util::BUF_SIZE + 10);
        $response = new Response(200, ['Content-Type' => 'application/pdf'], $content);

        $decoded = Util::decodeContent($response);

        $this->assertInstanceOf(\Iterator::class, $decoded);

        /** @var list<string> $chunks */
        $chunks = iterator_to_array($decoded, preserve_keys: false);
        $this->assertCount(2, $chunks);
        $this->assertSame($content, implode('', $chunks));
    }

    #[Test]
    public function testInvalidJsonThrows(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json'], '{"a":');

        $this->expectException(\JsonException::class);

        Util::decodeContent($response);
    }

    /**
     * @return array<string,mixed>
     */
    private static function webhook(): array
    {
        return ['id' => 'wh_1', 'events' => ['document.received'], 'secret' => 's', 'url' => 'https://example.com/hook'];
    }

    private function options(): RequestOptions
    {
        return RequestOptions::with(maxRetries: 0, transporter: $this->http);
    }
}
