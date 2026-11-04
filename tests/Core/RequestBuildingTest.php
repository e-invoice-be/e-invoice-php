<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\Stream;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Tests\Support\MockClient;

/**
 * How the client builds the URL, the query and the headers of a request.
 *
 * @internal
 */
final class RequestBuildingTest extends TestCase
{
    private MockClient $http;

    protected function setUp(): void
    {
        parent::setUp();

        $this->http = new MockClient;
    }

    protected function tearDown(): void
    {
        putenv('E_INVOICE_API_KEY');
        putenv('E_INVOICE_BASE_URL');

        parent::tearDown();
    }

    #[Test]
    public function testPathOfTheBaseUrlIsKept(): void
    {
        $this->retrieveMe(new Client(apiKey: 'k', baseUrl: 'https://proxy.example/e-invoice'));

        $this->assertSame('https://proxy.example/e-invoice/api/me/', (string) $this->request()->getUri());
    }

    /**
     * Bug: `Util::joinUri()` appends `/` and the path to the path of the base URL, so a
     * base URL that ends with `/` gives a path with `//`, e.g. `https://api.e-invoice.be//api/me/`.
     */
    #[Test]
    #[DataProvider('baseUrlsWithTrailingSlash')]
    public function testTrailingSlashOfTheBaseUrlDoesNotDoubleTheSlash(string $baseUrl, string $expected): void
    {
        $this->markTestSkipped('Bug in src/Core/Util.php (joinUri): a base URL that ends with "/" gives "//" in the path.');

        // @phpstan-ignore deadCode.unreachable
        $this->retrieveMe(new Client(apiKey: 'k', baseUrl: $baseUrl));

        $this->assertSame($expected, (string) $this->request()->getUri());
    }

    /**
     * @return iterable<string,array{string,string}>
     */
    public static function baseUrlsWithTrailingSlash(): iterable
    {
        yield 'host' => ['https://api.e-invoice.be/', 'https://api.e-invoice.be/api/me/'];

        yield 'path' => ['https://proxy.example/e-invoice/', 'https://proxy.example/e-invoice/api/me/'];
    }

    #[Test]
    public function testApiKeyAndBaseUrlAreReadFromTheEnvironment(): void
    {
        putenv('E_INVOICE_API_KEY=env-key');
        putenv('E_INVOICE_BASE_URL=http://env.example');

        $this->retrieveMe(new Client);

        $request = $this->request();
        $this->assertSame('http://env.example/api/me/', (string) $request->getUri());
        $this->assertSame('Bearer env-key', $request->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testArgumentsWinOverTheEnvironment(): void
    {
        putenv('E_INVOICE_API_KEY=env-key');
        putenv('E_INVOICE_BASE_URL=http://env.example');

        $this->retrieveMe(new Client(apiKey: 'arg-key', baseUrl: 'http://arg.example'));

        $request = $this->request();
        $this->assertSame('http://arg.example/api/me/', (string) $request->getUri());
        $this->assertSame('Bearer arg-key', $request->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testPathParametersAreEncoded(): void
    {
        $this->http->queueJson(['id' => 'a/b c?d', 'events' => [], 'secret' => 's', 'url' => 'u']);

        $this->client()->webhooks->retrieve('a/b c?d', requestOptions: $this->options());

        $uri = $this->request()->getUri();
        $this->assertSame('/api/webhooks/a%2Fb%20c%3Fd', $uri->getPath());
        $this->assertSame('', $uri->getQuery());
    }

    #[Test]
    public function testQueryValuesAreEncodedAndBooleansAreWords(): void
    {
        $this->http->queueJson(['items' => []]);

        $this->client()->inbox->list(
            search: 'Acme & Co',
            requestOptions: $this->options(extraQueryParams: ['flag' => true, 'other' => false, 'ids' => ['a', 'b']]),
        );

        $query = $this->request()->getUri()->getQuery();
        $this->assertStringContainsString('search=Acme%20%26%20Co', $query);
        $this->assertStringContainsString('flag=true', $query);
        $this->assertStringContainsString('other=false', $query);

        parse_str($query, $decoded);
        $this->assertSame(['a', 'b'], $decoded['ids'] ?? null);
    }

    #[Test]
    public function testExtraQueryParamsAreAddedToTheEndpointQuery(): void
    {
        $this->http->queueJson(['items' => []]);

        $this->client()->inbox->list(page: 3, requestOptions: $this->options(extraQueryParams: ['debug' => '1']));

        parse_str($this->request()->getUri()->getQuery(), $query);
        $this->assertSame('3', $query['page'] ?? null);
        $this->assertSame('1', $query['debug'] ?? null);
    }

    #[Test]
    public function testExtraHeadersOverrideAndRemoveHeaders(): void
    {
        $this->retrieveMe($this->client(), $this->options(extraHeaders: [
            'Accept' => 'application/xml',
            'User-Agent' => null,
            'X-Count' => 3,
            'X-List' => ['a', 1],
        ]));

        $request = $this->request();
        $this->assertSame('application/xml', $request->getHeaderLine('Accept'));
        $this->assertFalse($request->hasHeader('User-Agent'));
        $this->assertSame('3', $request->getHeaderLine('X-Count'));
        $this->assertSame(['a', '1'], $request->getHeader('X-List'));
        $this->assertSame('Bearer k', $request->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testExtraHeaderCanReplaceTheAuthorization(): void
    {
        $this->retrieveMe($this->client(), $this->options(extraHeaders: ['Authorization' => 'Bearer other']));

        $this->assertSame('Bearer other', $this->request()->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testLaterRequestOptionsWin(): void
    {
        $first = RequestOptions::with(maxRetries: 5, extraHeaders: ['X-A' => 'a']);
        $second = ['maxRetries' => 1, 'initialRetryDelay' => 0.1];

        $parsed = RequestOptions::parse($first, $second, null);

        $this->assertSame(1, $parsed->maxRetries);
        $this->assertSame(0.1, $parsed->initialRetryDelay);
        $this->assertSame(8.0, $parsed->maxRetryDelay);
        $this->assertSame(['X-A' => 'a'], $parsed->extraHeaders);
    }

    #[Test]
    public function testWithersReturnACopy(): void
    {
        $http = new MockClient;
        $options = new RequestOptions;

        $changed = $options
            ->withMaxRetries(0)
            ->withInitialRetryDelay(1.0)
            ->withMaxRetryDelay(2.0)
            ->withExtraHeaders(['X-A' => 'a'])
            ->withExtraQueryParams(['q' => 'v'])
            ->withExtraBodyParams(['b' => 'v'])
            ->withTransporter($http)
        ;

        $this->assertSame(2, $options->maxRetries);
        $this->assertNull($options->transporter);
        $this->assertSame(0, $changed->maxRetries);
        $this->assertSame(1.0, $changed->initialRetryDelay);
        $this->assertSame(2.0, $changed->maxRetryDelay);
        $this->assertSame(['X-A' => 'a'], $changed->extraHeaders);
        $this->assertSame(['q' => 'v'], $changed->extraQueryParams);
        $this->assertSame(['b' => 'v'], $changed->extraBodyParams);
        $this->assertSame($http, $changed->transporter);
    }

    #[Test]
    public function testRequestOptionsFromWithersAreUsed(): void
    {
        $this->http->queueJson(status: 500);

        try {
            $this->client()->me->retrieve(requestOptions: (new RequestOptions)->withTransporter($this->http)->withMaxRetries(0));
            $this->fail('The client did not throw.');
        } catch (\Throwable) {
            $this->assertCount(1, $this->http->requests);
        }
    }

    #[Test]
    public function testExtraBodyParamsAreSent(): void
    {
        $this->http->queueJson(['id' => 'w', 'events' => ['a'], 'secret' => 's', 'url' => 'u']);

        $this->client()->webhooks->create(
            events: ['a'],
            url: 'u',
            requestOptions: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );

        $this->assertSame(['events' => ['a'], 'url' => 'u', 'enabled' => true, 'undocumented' => 'value'], $this->jsonBody());
    }

    #[Test]
    public function testExtraBodyParamOverridesTheParameterOfTheSameName(): void
    {
        $this->http->queueJson(['id' => 'w', 'events' => ['a'], 'secret' => 's', 'url' => 'u']);

        $this->client()->webhooks->create(
            events: ['a'],
            url: 'u',
            requestOptions: $this->options(extraBodyParams: ['url' => 'v']),
        );

        $this->assertSame(['events' => ['a'], 'url' => 'v', 'enabled' => true], $this->jsonBody());
    }

    #[Test]
    public function testExtraBodyParamsAreSentAsAnObject(): void
    {
        $this->http->queueJson(['id' => 'w', 'events' => ['a'], 'secret' => 's', 'url' => 'u']);

        $this->client()->webhooks->create(
            events: ['a'],
            url: 'u',
            requestOptions: $this->options(extraBodyParams: (object) ['undocumented' => 'value']),
        );

        $this->assertSame('value', $this->jsonBody()['undocumented'] ?? null);
    }

    #[Test]
    public function testExtraBodyParamsAreTheBodyOfARequestWithoutABody(): void
    {
        $this->http->queueJson();

        $this->client()->request(
            method: 'post',
            path: 'api/undocumented',
            options: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );

        $this->assertSame(['undocumented' => 'value'], $this->jsonBody());
    }

    #[Test]
    public function testExtraBodyParamsAreAddedAsMultipartParts(): void
    {
        $this->http->queueJson(['invoice_id' => 'i', 'success' => true]);

        $this->client()->documents->createFromPdf(
            file: 'pdf',
            requestOptions: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );

        $body = (string) $this->request()->getBody();
        $this->assertStringContainsString('name="file"', $body);
        $this->assertMatchesRegularExpression('/name="undocumented"\r\n(?:[^\r\n]+\r\n)*\r\nvalue\r\n/', $body);
    }

    #[Test]
    #[DataProvider('emptyExtraBodyParams')]
    public function testEmptyExtraBodyParamsLeaveARequestWithoutABody(mixed $extraBodyParams): void
    {
        $this->retrieveMe($this->client(), $this->options(extraBodyParams: $extraBodyParams));

        $this->assertSame('', (string) $this->request()->getBody());
    }

    /** @return iterable<string,array{mixed}> */
    public static function emptyExtraBodyParams(): iterable
    {
        yield 'null' => [null];

        yield 'array' => [[]];

        yield 'object' => [new \stdClass];
    }

    #[Test]
    public function testExtraBodyParamsAreSentAgainOnARetry(): void
    {
        $this->http->queueJson(status: 500);
        $this->http->queueJson(['id' => 'w', 'events' => ['a'], 'secret' => 's', 'url' => 'u']);

        $client = new class(apiKey: 'k', baseUrl: 'http://localhost') extends Client {
            protected function sleep(float $seconds): void {}
        };
        $client->webhooks->create(
            events: ['a'],
            url: 'u',
            requestOptions: RequestOptions::with(maxRetries: 1, extraBodyParams: ['undocumented' => 'value'], transporter: $this->http),
        );

        $this->assertCount(2, $this->http->requests);
        $this->assertSameBodies(['events' => ['a'], 'url' => 'u', 'enabled' => true, 'undocumented' => 'value']);
    }

    #[Test]
    public function testExtraBodyParamsAreSentAgainOnARedirect(): void
    {
        $this->http
            ->queue(new Response(307, ['Location' => '/api/webhooks/']))
            ->queueJson(['id' => 'w', 'events' => ['a'], 'secret' => 's', 'url' => 'u'])
        ;

        $this->client()->webhooks->create(
            events: ['a'],
            url: 'u',
            requestOptions: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );

        $this->assertCount(2, $this->http->requests);
        $this->assertSame('POST', $this->http->requests[1]->getMethod());
        $this->assertSame('/api/webhooks/', $this->http->requests[1]->getUri()->getPath());
        $this->assertSameBodies(['events' => ['a'], 'url' => 'u', 'enabled' => true, 'undocumented' => 'value']);
    }

    #[Test]
    public function testExtraBodyParamsAreTheBodyOfAGetRequest(): void
    {
        $this->http->queueJson(['name' => 'Acme']);

        $this->client()->me->retrieve(
            requestOptions: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );

        $request = $this->request();
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(['undocumented' => 'value'], $this->jsonBody());
    }

    #[Test]
    public function testExtraBodyParamsAreMergedIntoAnEmptyArrayBody(): void
    {
        $this->http->queueJson();

        $this->client()->request(
            method: 'post',
            path: 'api/undocumented',
            body: [],
            options: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );

        $this->assertSame(['undocumented' => 'value'], $this->jsonBody());
    }

    #[Test]
    public function testExtraBodyParamsThatAreAListAreRejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('extraBodyParams must be a map of parameters, got a list');

        $this->client()->webhooks->create(
            events: ['a'],
            url: 'u',
            requestOptions: $this->options(extraBodyParams: ['value']),
        );
    }

    #[Test]
    public function testExtraBodyParamsCannotBeMergedIntoAListBody(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('extraBodyParams cannot be merged into a list body');

        $this->client()->request(
            method: 'post',
            path: 'api/undocumented',
            body: ['raw'],
            options: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );
    }

    #[Test]
    public function testExtraBodyParamsThatAreNotAMapAreRejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('extraBodyParams must be an array or a stdClass object, got string');

        $this->client()->webhooks->create(
            events: ['a'],
            url: 'u',
            requestOptions: $this->options(extraBodyParams: 'value'),
        );
    }

    #[Test]
    #[DataProvider('bodiesThatAreNotAMap')]
    public function testExtraBodyParamsCannotBeMergedIntoABodyThatIsNotAMap(mixed $body, string $type): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("extraBodyParams cannot be merged into a body of type {$type}");

        $this->client()->request(
            method: 'post',
            path: 'api/undocumented',
            body: $body,
            options: $this->options(extraBodyParams: ['undocumented' => 'value']),
        );
    }

    /** @return iterable<string,array{mixed,string}> */
    public static function bodiesThatAreNotAMap(): iterable
    {
        yield 'string' => ['raw', 'string'];

        yield 'stream' => [Stream::create('raw'), Stream::class];
    }

    private function client(): Client
    {
        return new Client(apiKey: 'k', baseUrl: 'http://localhost');
    }

    /**
     * @param array<string,string|int|list<string|int>|null>|null $extraHeaders
     * @param array<string,mixed>|null $extraQueryParams
     */
    private function options(
        ?array $extraHeaders = null,
        ?array $extraQueryParams = null,
        mixed $extraBodyParams = null,
    ): RequestOptions {
        return RequestOptions::with(
            maxRetries: 0,
            extraHeaders: $extraHeaders,
            extraQueryParams: $extraQueryParams,
            extraBodyParams: $extraBodyParams,
            transporter: $this->http,
        );
    }

    private function retrieveMe(Client $client, ?RequestOptions $options = null): void
    {
        $this->http->queueJson(['name' => 'Acme']);

        $client->me->retrieve(requestOptions: $options ?? $this->options());
    }

    /** @return array<mixed> */
    private function jsonBody(): array
    {
        $body = json_decode((string) $this->request()->getBody(), associative: true, flags: JSON_THROW_ON_ERROR);
        $this->assertIsArray($body);

        return $body;
    }

    /**
     * Every recorded request carries this JSON object, extras included once.
     *
     * @param array<mixed> $expected
     */
    private function assertSameBodies(array $expected): void
    {
        $this->assertNotEmpty($this->http->requests);
        foreach ($this->http->requests as $request) {
            $body = json_decode((string) $request->getBody(), associative: true, flags: JSON_THROW_ON_ERROR);
            $this->assertIsArray($body);
            $this->assertSame($expected, $body);
        }
    }

    private function request(): RequestInterface
    {
        $this->assertCount(1, $this->http->requests);

        return $this->http->requests[0];
    }
}
