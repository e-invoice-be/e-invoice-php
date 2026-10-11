<?php

namespace Tests\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\RequestOptions;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Tests\Support\MockClient;

/**
 * @internal
 */
abstract class ServiceTestCase extends TestCase
{
    protected const BASE_URL = 'http://localhost';

    protected Client $client;

    protected MockClient $http;

    protected function setUp(): void
    {
        parent::setUp();

        $this->http = new MockClient;
        $this->client = new Client(apiKey: 'My API Key', baseUrl: self::BASE_URL);
    }

    protected function options(): RequestOptions
    {
        return RequestOptions::with(transporter: $this->http);
    }

    /**
     * Asserts on the request at `$index` and returns it for more assertions.
     *
     * `$query` holds the decoded query string, so all scalar values are strings.
     * `$body` is the decoded JSON body as an array, a raw body as a string, or `null` for an empty body.
     *
     * @param array<string,mixed> $query
     * @param array<mixed>|string|null $body
     */
    protected function assertRequest(
        string $method,
        string $path,
        array $query = [],
        array|string|null $body = null,
        int $index = 0,
    ): RequestInterface {
        $this->assertArrayHasKey($index, $this->http->requests, 'The client did not send this request.');
        $request = $this->http->requests[$index];

        $this->assertSame($method, $request->getMethod());
        $this->assertSame($path, $request->getUri()->getPath());
        $this->assertSame('Bearer My API Key', $request->getHeaderLine('Authorization'));

        parse_str($request->getUri()->getQuery(), $sentQuery);
        $this->assertEquals($query, $sentQuery);

        $sentBody = (string) $request->getBody();
        if (is_array($body)) {
            $this->assertStringStartsWith('application/json', $request->getHeaderLine('Content-Type'));
            $this->assertEquals($body, json_decode($sentBody, associative: true, flags: JSON_THROW_ON_ERROR));
        } else {
            $this->assertSame($body ?? '', $sentBody);
        }

        return $request;
    }
}
