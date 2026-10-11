<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIConnectionException;
use EInvoiceAPI\Core\Exceptions\APITimeoutException;
use EInvoiceAPI\RequestOptions;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Tests\Support\MockClient;

/**
 * @internal
 */
#[CoversNothing]
final class ClientTest extends TestCase
{
    private Client $client;

    private MockClient $http;

    protected function setUp(): void
    {
        parent::setUp();

        $this->http = new MockClient;
        $this->client = new Client(apiKey: 'My API Key', baseUrl: 'http://localhost');
    }

    #[Test]
    public function testUserAgentHasTheSdkVersion(): void
    {
        $this->http->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options());

        $this->assertMatchesRegularExpression('/^\d+\.\d+\.\d+$/', Client::VERSION);
        $this->assertSame('e-invoice/PHP '.Client::VERSION, $this->http->requests[0]->getHeaderLine('User-Agent'));
    }

    #[Test]
    public function testRequestHasNoTelemetryHeaders(): void
    {
        $this->http->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options());

        $names = array_map('strtolower', array_keys($this->http->requests[0]->getHeaders()));
        sort($names);
        $this->assertSame(['accept', 'authorization', 'content-type', 'host', 'user-agent'], $names);
    }

    #[Test]
    #[DataProvider('timeouts')]
    public function testTimeoutThrowsTimeoutException(string $message): void
    {
        $timeout = $this->networkError($message);
        $this->http->queue($timeout);

        try {
            $this->client->me->retrieve(requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (APITimeoutException $e) {
            $this->assertSame($timeout, $e->getPrevious());
            $this->assertStringEndsWith('Request timed out.', $e->getMessage());
        }
    }

    /**
     * @return iterable<string,array{string}>
     */
    public static function timeouts(): iterable
    {
        yield 'curl' => ['cURL error 28: Operation timed out after 60001 milliseconds with 0 bytes received'];

        yield 'symfony' => ['Idle timeout reached for "http://localhost/api/me/".'];

        yield 'stream' => ['Connection timed out'];

        yield 'hyphen' => ['Gateway time-out'];
    }

    #[Test]
    public function testWrappedTimeoutThrowsTimeoutException(): void
    {
        $this->http->queue($this->networkError('Transport failed', new \RuntimeException('Operation timed out')));

        $this->expectException(APITimeoutException::class);

        $this->client->me->retrieve(requestOptions: $this->options());
    }

    #[Test]
    #[DataProvider('networkErrors')]
    public function testNetworkErrorThrowsConnectionException(string $message): void
    {
        $refused = $this->networkError($message);
        $this->http->queue($refused);

        try {
            $this->client->me->retrieve(requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (APIConnectionException $e) {
            $this->assertNotInstanceOf(APITimeoutException::class, $e);
            $this->assertSame($refused, $e->getPrevious());
        }
    }

    /**
     * @return iterable<string,array{string}>
     */
    public static function networkErrors(): iterable
    {
        yield 'refused' => ['Connection refused'];

        yield 'url with timeout' => ['Could not resolve host for "http://localhost/timeout?timeout=30"'];
    }

    private function options(): RequestOptions
    {
        return RequestOptions::with(transporter: $this->http, maxRetries: 0);
    }

    private function networkError(string $message, ?\Throwable $previous = null): NetworkExceptionInterface
    {
        return new class($message, $previous) extends \RuntimeException implements NetworkExceptionInterface {
            public function __construct(string $message, ?\Throwable $previous)
            {
                parent::__construct($message, previous: $previous);
            }

            public function getRequest(): RequestInterface
            {
                throw new \LogicException('Not used.');
            }
        };
    }
}
