<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIStatusException;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
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
}
