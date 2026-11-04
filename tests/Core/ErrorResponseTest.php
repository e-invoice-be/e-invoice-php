<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIStatusException;
use EInvoiceAPI\Core\Exceptions\AuthenticationException;
use EInvoiceAPI\Core\Exceptions\InternalServerException;
use EInvoiceAPI\Core\Exceptions\NotFoundException;
use EInvoiceAPI\Core\Exceptions\UnprocessableEntityException;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Support\MockClient;

/**
 * @internal
 */
final class ErrorResponseTest extends TestCase
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
    public function testErrorResponseBodyIsExposed(): void
    {
        $this->http->queueJson(['detail' => 'Webhook not found'], 404);

        try {
            $this->client->webhooks->retrieve('webhook_id', requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (NotFoundException $e) {
            $this->assertSame(404, $e->status);
            $this->assertSame(['detail' => 'Webhook not found'], $e->body);
            $this->assertStringContainsString('Webhook not found', $e->getMessage());
        }
    }

    #[Test]
    public function testValidationErrorBodyIsExposed(): void
    {
        // The 422 of `GET /api/webhooks/{webhook_id}` is an `HTTPValidationError`.
        $detail = [['loc' => ['path', 'webhook_id'], 'msg' => 'Field required', 'type' => 'missing']];
        $this->http->queueJson(['detail' => $detail], 422);

        try {
            $this->client->webhooks->retrieve('webhook_id', requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (UnprocessableEntityException $e) {
            $this->assertSame(422, $e->status);
            $this->assertSame(['detail' => $detail], $e->body);
        }
    }

    #[Test]
    public function testUnprocessableEntityWithErrorResponseBodyIsExposed(): void
    {
        // The 422 of `POST /api/webhooks/{webhook_id}/test` is an `ErrorResponse`.
        $this->http->queueJson(['detail' => 'Invalid event type'], 422);

        try {
            $this->client->webhooks->test(
                'webhook_id',
                data: [],
                eventType: 'not.an.event',
                requestOptions: $this->options(),
            );
            $this->fail('The client did not throw.');
        } catch (UnprocessableEntityException $e) {
            $this->assertSame(422, $e->status);
            $this->assertSame(['detail' => 'Invalid event type'], $e->body);
        }
    }

    #[Test]
    public function testUnauthorizedThrowsAuthenticationException(): void
    {
        $this->http->queueJson(['detail' => 'Invalid API key'], 401);

        $this->expectException(AuthenticationException::class);

        $this->client->webhooks->list(requestOptions: $this->options());
    }

    #[Test]
    public function testNonJsonErrorBodyIsKeptAsText(): void
    {
        $this->http->queue(new Response(502, ['Content-Type' => 'text/html'], '<html>Bad Gateway</html>'));

        try {
            $this->client->conversion->retrieve('task_id', requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (InternalServerException $e) {
            $this->assertSame(502, $e->status);
            $this->assertSame('<html>Bad Gateway</html>', $e->body);
        }
    }

    #[Test]
    public function testEmptyErrorBodyIsNull(): void
    {
        $this->http->queue(new Response(500));

        try {
            $this->client->conversion->retrieve('task_id', requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (InternalServerException $e) {
            $this->assertNull($e->body);
        }
    }

    #[Test]
    public function testMessageIsPrependedOnce(): void
    {
        $e = APIStatusException::from(
            new Request('GET', 'http://localhost/api/webhooks/'),
            new Response(405, ['Content-Type' => 'application/json'], '{"detail":"Method not allowed"}'),
            message: 'Context',
        );

        $this->assertSame(1, substr_count($e->getMessage(), 'Method not allowed'));
        $this->assertStringContainsString(PHP_EOL.'Context'.PHP_EOL.'{', $e->getMessage());
    }

    private function options(): RequestOptions
    {
        return RequestOptions::with(transporter: $this->http, maxRetries: 0);
    }
}
