<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIConnectionException;
use EInvoiceAPI\Core\Exceptions\APIStatusException;
use EInvoiceAPI\Core\Exceptions\AuthenticationException;
use EInvoiceAPI\Core\Exceptions\BadRequestException;
use EInvoiceAPI\Core\Exceptions\ConflictException;
use EInvoiceAPI\Core\Exceptions\InternalServerException;
use EInvoiceAPI\Core\Exceptions\NotFoundException;
use EInvoiceAPI\Core\Exceptions\PermissionDeniedException;
use EInvoiceAPI\Core\Exceptions\RateLimitException;
use EInvoiceAPI\Core\Exceptions\UnprocessableEntityException;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Support\MockClient;

/**
 * Which status codes are retried, followed or thrown, and as which exception.
 *
 * @internal
 */
final class ResponseStatusTest extends TestCase
{
    /** @var Client&object{sleeps: list<float>} */
    private Client $client;

    private MockClient $http;

    protected function setUp(): void
    {
        parent::setUp();

        $this->http = new MockClient;
        $this->client = new class(apiKey: 'k', baseUrl: 'http://localhost') extends Client {
            /** @var list<float> */
            public array $sleeps = [];

            protected function sleep(float $seconds): void
            {
                $this->sleeps[] = $seconds;
            }
        };
    }

    /**
     * @param class-string<APIStatusException> $class
     */
    #[Test]
    #[DataProvider('statusExceptions')]
    public function testStatusIsThrownAsItsException(int $status, string $class): void
    {
        $this->http->queueJson(['detail' => 'no'], $status);

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 0));
            $this->fail('The client did not throw.');
        } catch (APIStatusException $e) {
            $this->assertSame($class, $e::class);
            $this->assertSame($status, $e->status);
            $this->assertSame($status, $e->response?->getStatusCode());
            $this->assertSame('/api/me/', $e->request->getUri()->getPath());
        }
    }

    /**
     * @return iterable<string,array{int,class-string<APIStatusException>}>
     */
    public static function statusExceptions(): iterable
    {
        yield '400' => [400, BadRequestException::class];

        yield '401' => [401, AuthenticationException::class];

        yield '403' => [403, PermissionDeniedException::class];

        yield '404' => [404, NotFoundException::class];

        // The spec documents 405, 406 and 415 (`ErrorResponse`) without a dedicated exception.
        yield '405' => [405, APIStatusException::class];

        yield '406' => [406, APIStatusException::class];

        yield '409' => [409, ConflictException::class];

        yield '415' => [415, APIStatusException::class];

        yield '418' => [418, APIStatusException::class];

        yield '422' => [422, UnprocessableEntityException::class];

        yield '429' => [429, RateLimitException::class];

        yield '500' => [500, InternalServerException::class];

        yield '503' => [503, InternalServerException::class];
    }

    #[Test]
    #[DataProvider('retriedStatuses')]
    public function testStatusIsRetried(int $status): void
    {
        $this->http->queueJson(status: $status)->queueJson(['name' => 'Acme']);

        $result = $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));

        $this->assertSame('Acme', $result->name);
        $this->assertCount(2, $this->http->requests);
        $this->assertCount(1, $this->client->sleeps);
    }

    /**
     * @return iterable<string,array{int}>
     */
    public static function retriedStatuses(): iterable
    {
        foreach ([408, 409, 429, 500, 502, 503, 504] as $status) {
            yield (string) $status => [$status];
        }
    }

    #[Test]
    #[DataProvider('notRetriedStatuses')]
    public function testClientErrorIsNotRetried(int $status): void
    {
        $this->http->queueJson(status: $status);

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 3));
            $this->fail('The client did not throw.');
        } catch (APIStatusException $e) {
            $this->assertSame($status, $e->status);
        }

        $this->assertCount(1, $this->http->requests);
        $this->assertSame([], $this->client->sleeps);
    }

    /**
     * @return iterable<string,array{int}>
     */
    public static function notRetriedStatuses(): iterable
    {
        foreach ([400, 401, 403, 404, 422] as $status) {
            yield (string) $status => [$status];
        }
    }

    #[Test]
    public function testLastRetryThrowsTheErrorOfTheLastResponse(): void
    {
        $this->http
            ->queueJson(['detail' => 'first'], 503)
            ->queueJson(['detail' => 'second'], 429)
        ;

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 1));
            $this->fail('The client did not throw.');
        } catch (RateLimitException $e) {
            $this->assertSame(['detail' => 'second'], $e->body);
        }

        $this->assertCount(2, $this->http->requests);
    }

    #[Test]
    public function testRelativeRedirectIsFollowedOnTheSameHost(): void
    {
        $this->http
            ->queue(new Response(302, ['Location' => '/api/me/v2?x=1']))
            ->queueJson(['name' => 'Acme'])
        ;

        $result = $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 0));

        $this->assertSame('Acme', $result->name);
        $this->assertCount(2, $this->http->requests);
        $second = $this->http->requests[1];
        $this->assertSame('http://localhost/api/me/v2?x=1', (string) $second->getUri());
        $this->assertSame('GET', $second->getMethod());
        $this->assertSame('Bearer k', $second->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testAbsoluteRedirectIsFollowedToTheOtherHost(): void
    {
        $this->http
            ->queue(new Response(301, ['Location' => 'https://other.example:8443/api/me/']))
            ->queueJson(['name' => 'Acme'])
        ;

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 0));

        $this->assertSame('https://other.example:8443/api/me/', (string) $this->http->requests[1]->getUri());
    }

    #[Test]
    public function testRedirectWithoutLocationThrowsAConnectionException(): void
    {
        $this->http->queue(new Response(302));

        $this->expectException(APIConnectionException::class);
        $this->expectExceptionMessage('Redirection without Location header');

        $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 0));
    }

    #[Test]
    public function testRedirectLoopStopsAfterTwentyRedirects(): void
    {
        for ($i = 0; $i < 25; ++$i) {
            $this->http->queue(new Response(302, ['Location' => '/api/me/']));
        }

        try {
            $this->client->me->retrieve(requestOptions: $this->options(maxRetries: 0));
            $this->fail('The client did not throw.');
        } catch (APIConnectionException $e) {
            $this->assertStringContainsString('Maximum redirects exceeded', $e->getMessage());
        }

        $this->assertCount(21, $this->http->requests);
    }

    #[Test]
    public function testNoContentIsParsedAsNull(): void
    {
        $this->http->queue(new Response(204));

        $response = $this->client->request(method: 'delete', path: 'api/anything', options: $this->options(maxRetries: 0));

        $this->assertSame(204, $response->getStatusCode());
        $this->assertNull($response->parse());
    }

    private function options(int $maxRetries): RequestOptions
    {
        return RequestOptions::with(maxRetries: $maxRetries, transporter: $this->http);
    }
}
