<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIConnectionException;
use EInvoiceAPI\Core\Exceptions\APIStatusException;
use EInvoiceAPI\Core\Exceptions\APITimeoutException;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Tests\Support\MockClient;

/**
 * @internal
 */
#[CoversNothing]
final class RetryTest extends TestCase
{
    /** @var Client&object{sleeps: list<float>} */
    private Client $client;

    private MockClient $http;

    protected function setUp(): void
    {
        parent::setUp();

        $this->http = new MockClient;
        $this->client = new class(apiKey: 'My API Key', baseUrl: 'http://localhost') extends Client {
            /** @var list<float> */
            public array $sleeps = [];

            protected function sleep(float $seconds): void
            {
                $this->sleeps[] = $seconds;
            }
        };
    }

    #[Test]
    public function testFirstRetryWaitsTheInitialDelay(): void
    {
        $this->http->queueJson(status: 500)->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertCount(2, $this->http->requests);
        $this->assertCount(1, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
    }

    #[Test]
    public function testDelayDoublesForEachRetryUpToTheMaximum(): void
    {
        for ($i = 0; $i < 6; ++$i) {
            $this->http->queueJson(status: 503);
        }
        $this->http->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 6, initialRetryDelay: 0.5, maxRetryDelay: 5.0));

        $sleeps = $this->client->sleeps;
        $this->assertCount(6, $sleeps);
        $this->assertDelayAround(0.5, $sleeps[0]);
        $this->assertDelayAround(1.0, $sleeps[1]);
        $this->assertDelayAround(2.0, $sleeps[2]);
        $this->assertDelayAround(4.0, $sleeps[3]);
        $this->assertDelayAround(5.0, $sleeps[4]);
        $this->assertLessThanOrEqual(5.0, $sleeps[4]);
        $this->assertLessThanOrEqual(5.0, $sleeps[5]);
    }

    #[Test]
    public function testRedirectsDoNotChangeTheRetryNumber(): void
    {
        $this->http
            ->queue(new Response(302, ['Location' => '/api/me/']))
            ->queue(new Response(302, ['Location' => '/api/me/']))
            ->queueJson(status: 500)
            ->queueJson(['name' => 'Acme'])
        ;

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertCount(1, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
    }

    #[Test]
    public function testNumericRetryAfterIsUsed(): void
    {
        $this->http->queueJson(status: 429, headers: ['Retry-After' => '1.5'])->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertSame([1.5], $this->client->sleeps);
    }

    #[Test]
    public function testDateRetryAfterIsTheTimeUntilThatDate(): void
    {
        $date = gmdate('D, d M Y H:i:s \G\M\T', time() + 30);
        $this->http->queueJson(status: 429, headers: ['Retry-After' => $date])->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertCount(1, $this->client->sleeps);
        $this->assertGreaterThanOrEqual(28.0, $this->client->sleeps[0]);
        $this->assertLessThanOrEqual(30.0, $this->client->sleeps[0]);
    }

    #[Test]
    public function testRetryAfterInThePastFallsBackToTheBackoff(): void
    {
        $date = gmdate('D, d M Y H:i:s \G\M\T', time() - 30);
        $this->http->queueJson(status: 429, headers: ['Retry-After' => $date])->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertCount(1, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
    }

    #[Test]
    public function testRetryAfterOverOneMinuteFallsBackToTheBackoff(): void
    {
        $this->http->queueJson(status: 429, headers: ['Retry-After' => '3600'])->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertCount(1, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
    }

    #[Test]
    public function testInvalidRetryAfterFallsBackToTheBackoff(): void
    {
        $this->http->queueJson(status: 429, headers: ['Retry-After' => 'not a date'])->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertCount(1, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
    }

    #[Test]
    public function testRelativeRetryAfterFallsBackToTheBackoff(): void
    {
        $this->http->queueJson(status: 429, headers: ['Retry-After' => '+30 seconds'])->queueJson(['name' => 'Acme']);

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertCount(1, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
    }

    #[Test]
    public function testNoSleepWithoutRetry(): void
    {
        $this->http->queueJson(status: 500);

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 0));
            $this->fail('The client did not throw.');
        } catch (APIStatusException) {
        }

        $this->assertSame([], $this->client->sleeps);
    }

    #[Test]
    public function testGetIsRetriedAfterAConnectionError(): void
    {
        $this->http->queue($this->networkError('Connection refused'))->queueJson(['name' => 'Acme']);

        $me = $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 2));

        $this->assertSame('Acme', $me->name);
        $this->assertCount(2, $this->http->requests);
        $this->assertCount(1, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
    }

    #[Test]
    #[DataProvider('idempotentMethods')]
    public function testIdempotentMethodIsRetriedAfterATimeout(string $method): void
    {
        $this->http->queue($this->networkError('Operation timed out'))->queueJson();

        $this->client->request($method, path: 'api/me', options: $this->options(maxRetries: 2));

        $this->assertCount(2, $this->http->requests);
        $this->assertSame(strtoupper($method), $this->http->requests[1]->getMethod());
        $this->assertCount(1, $this->client->sleeps);
    }

    /**
     * @return iterable<string,array{string}>
     */
    public static function idempotentMethods(): iterable
    {
        yield 'GET' => ['get'];

        yield 'HEAD' => ['head'];

        yield 'PUT' => ['put'];

        yield 'DELETE' => ['delete'];

        yield 'OPTIONS' => ['options'];
    }

    #[Test]
    #[DataProvider('nonIdempotentMethods')]
    public function testNonIdempotentMethodIsNotRetriedAfterAConnectionError(string $method): void
    {
        $refused = $this->networkError('Connection refused');
        $this->http->queue($refused)->queueJson();

        try {
            $this->client->request($method, path: 'api/documents', body: ['a' => 1], options: $this->options(maxRetries: 2));
            $this->fail('The client did not throw.');
        } catch (APIConnectionException $e) {
            $this->assertNotInstanceOf(APITimeoutException::class, $e);
            $this->assertSame($refused, $e->getPrevious());
        }

        $this->assertCount(1, $this->http->requests);
        $this->assertSame([], $this->client->sleeps);
    }

    #[Test]
    #[DataProvider('nonIdempotentMethods')]
    public function testNonIdempotentMethodIsNotRetriedAfterATimeout(string $method): void
    {
        $this->http->queue($this->networkError('Operation timed out'))->queueJson();

        try {
            $this->client->request($method, path: 'api/documents', body: ['a' => 1], options: $this->options(maxRetries: 2));
            $this->fail('The client did not throw.');
        } catch (APITimeoutException) {
        }

        $this->assertCount(1, $this->http->requests);
        $this->assertSame([], $this->client->sleeps);
    }

    /**
     * @return iterable<string,array{string}>
     */
    public static function nonIdempotentMethods(): iterable
    {
        yield 'POST' => ['post'];

        yield 'PATCH' => ['patch'];
    }

    #[Test]
    public function testPostIsStillRetriedAfterAServerError(): void
    {
        $this->http->queueJson(status: 503)->queueJson();

        $this->client->request('post', path: 'api/documents', body: ['a' => 1], options: $this->options(maxRetries: 2));

        $this->assertCount(2, $this->http->requests);
        $this->assertCount(1, $this->client->sleeps);
    }

    #[Test]
    public function testRetryOfAMultipartRequestHasOneBoundary(): void
    {
        $this->http->queueJson(status: 503)->queueJson();

        $this->client->request(
            'post',
            path: 'api/documents/pdf',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: ['file' => 'content'],
            options: $this->options(maxRetries: 1),
        );

        $this->assertCount(2, $this->http->requests);
        foreach ($this->http->requests as $request) {
            $this->assertMultipartBody($request, 'content');
        }
    }

    #[Test]
    public function testRedirectOfAMultipartRequestKeepsTheMethodAndOneBoundary(): void
    {
        $this->http
            ->queue(new Response(307, ['Location' => '/api/documents/pdf/']))
            ->queueJson()
        ;

        $this->client->request(
            'post',
            path: 'api/documents/pdf',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: ['file' => 'content'],
            options: $this->options(maxRetries: 0),
        );

        $this->assertCount(2, $this->http->requests);
        $this->assertSame('POST', $this->http->requests[1]->getMethod());
        $this->assertSame('/api/documents/pdf/', $this->http->requests[1]->getUri()->getPath());
        foreach ($this->http->requests as $request) {
            $this->assertMultipartBody($request, 'content');
        }
        $this->assertSame([], $this->client->sleeps);
    }

    #[Test]
    public function testPutBodyIsSentAgainAfterAConnectionError(): void
    {
        $this->http->queue($this->networkError('Connection refused'))->queueJson();

        $this->client->request(
            'put',
            path: 'api/documents/doc_1',
            body: ['a' => 1],
            options: $this->options(maxRetries: 1),
        );

        $this->assertCount(2, $this->http->requests);
        foreach ($this->http->requests as $request) {
            $this->assertSame('PUT', $request->getMethod());
            $this->assertSame('{"a":1}', (string) $request->getBody());
            $this->assertSame('application/json', $request->getHeaderLine('Content-Type'));
            $this->assertSame('', $request->getHeaderLine('Content-Length'));
        }
    }

    #[Test]
    public function testConnectionErrorsAreRetriedAtMostMaxRetriesTimes(): void
    {
        $last = $this->networkError('Connection refused');
        $this->http
            ->queue($this->networkError('Connection refused'))
            ->queue($this->networkError('Connection refused'))
            ->queue($last)
            ->queueJson(['name' => 'Acme'])
        ;

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 2));
            $this->fail('The client did not throw.');
        } catch (APIConnectionException $e) {
            $this->assertNotInstanceOf(APITimeoutException::class, $e);
            $this->assertSame($last, $e->getPrevious());
        }

        $this->assertCount(3, $this->http->requests);
        $this->assertCount(2, $this->client->sleeps);
        $this->assertDelayAround(0.5, $this->client->sleeps[0]);
        $this->assertDelayAround(1.0, $this->client->sleeps[1]);
    }

    #[Test]
    public function testTimeoutIsThrownAfterTheLastAttempt(): void
    {
        $last = $this->networkError('Operation timed out');
        $this->http->queue($this->networkError('Operation timed out'))->queue($last);

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));
            $this->fail('The client did not throw.');
        } catch (APITimeoutException $e) {
            $this->assertSame($last, $e->getPrevious());
        }

        $this->assertCount(2, $this->http->requests);
        $this->assertCount(1, $this->client->sleeps);
    }

    #[Test]
    public function testConnectionErrorIsNotRetriedWithZeroMaxRetries(): void
    {
        $this->http->queue($this->networkError('Connection refused'))->queueJson(['name' => 'Acme']);

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 0));
            $this->fail('The client did not throw.');
        } catch (APIConnectionException) {
        }

        $this->assertCount(1, $this->http->requests);
        $this->assertSame([], $this->client->sleeps);
    }

    #[Test]
    public function testGetIsNotRetriedAfterAnInvalidRequest(): void
    {
        $invalid = $this->requestError('Invalid HTTP method');
        $this->http->queue($invalid)->queueJson(['name' => 'Acme']);

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 2));
            $this->fail('The client did not throw.');
        } catch (APIConnectionException $e) {
            $this->assertNotInstanceOf(APITimeoutException::class, $e);
            $this->assertSame($invalid, $e->getPrevious());
        }

        $this->assertCount(1, $this->http->requests);
        $this->assertSame([], $this->client->sleeps);
    }

    #[Test]
    public function testGetIsRetriedAfterAClientExceptionThatIsNotANetworkException(): void
    {
        $this->http->queue($this->clientError('Idle timeout reached'))->queueJson(['name' => 'Acme']);

        $me = $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 2));

        $this->assertSame('Acme', $me->name);
        $this->assertCount(2, $this->http->requests);
        $this->assertCount(1, $this->client->sleeps);
    }

    #[Test]
    public function testGetIsRetriedWhenANetworkErrorIsAlsoARequestException(): void
    {
        $error = $this->networkAndRequestError('Connection refused');
        $this->assertInstanceOf(RequestExceptionInterface::class, $error);
        $this->http->queue($error)->queueJson(['name' => 'Acme']);

        $me = $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 2));

        $this->assertSame('Acme', $me->name);
        $this->assertCount(2, $this->http->requests);
        $this->assertCount(1, $this->client->sleeps);
    }

    #[Test]
    public function testDefaultSleepWaitsTheFractionOfASecond(): void
    {
        $client = new Client(apiKey: 'My API Key', baseUrl: 'http://localhost');
        $this->http->queueJson(status: 429, headers: ['Retry-After' => '0.2'])->queueJson(['name' => 'Acme']);

        $start = microtime(true);
        $client->me->retrieve(requestOptions: $this->options(maxRetries: 1));
        $elapsed = microtime(true) - $start;

        $this->assertGreaterThanOrEqual(0.19, $elapsed);
        $this->assertLessThan(1.0, $elapsed);
    }

    private function options(int $maxRetries, float $initialRetryDelay = 0.5, float $maxRetryDelay = 8.0): RequestOptions
    {
        return RequestOptions::with(
            transporter: $this->http,
            maxRetries: $maxRetries,
            initialRetryDelay: $initialRetryDelay,
            maxRetryDelay: $maxRetryDelay,
        );
    }

    /**
     * The jitter takes up to 25% off the delay.
     */
    private function assertDelayAround(float $expected, float $actual): void
    {
        $this->assertGreaterThanOrEqual($expected * 0.75, $actual);
        $this->assertLessThanOrEqual($expected, $actual);
    }

    private function assertMultipartBody(RequestInterface $request, string $content): void
    {
        $contentType = $request->getHeaderLine('Content-Type');
        $this->assertSame(1, substr_count($contentType, 'boundary='), $contentType);
        $this->assertSame(1, preg_match('/boundary=(\S+)$/', $contentType, $matches), $contentType);
        $body = (string) $request->getBody();
        $this->assertStringContainsString('--'.$matches[1], $body);
        $this->assertStringContainsString($content, $body);
    }

    private function networkError(string $message): NetworkExceptionInterface
    {
        return new class($message) extends \RuntimeException implements NetworkExceptionInterface {
            public function getRequest(): RequestInterface
            {
                throw new \LogicException('Not used.');
            }
        };
    }

    private function requestError(string $message): RequestExceptionInterface
    {
        return new class($message) extends \RuntimeException implements RequestExceptionInterface {
            public function getRequest(): RequestInterface
            {
                throw new \LogicException('Not used.');
            }
        };
    }

    /**
     * Some HTTP clients make the network exception a subclass of the request exception.
     */
    private function networkAndRequestError(string $message): NetworkExceptionInterface
    {
        return new class($message) extends \RuntimeException implements NetworkExceptionInterface, RequestExceptionInterface {
            public function getRequest(): RequestInterface
            {
                throw new \LogicException('Not used.');
            }
        };
    }

    private function clientError(string $message): ClientExceptionInterface
    {
        return new class($message) extends \RuntimeException implements ClientExceptionInterface {};
    }
}
