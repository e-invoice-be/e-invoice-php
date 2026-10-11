<?php

namespace Tests\Services;

use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookGetHistoryResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookTestResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
#[CoversNothing]
final class WebhooksTest extends ServiceTestCase
{
    #[Test]
    public function testCreate(): void
    {
        $this->http->queueJson(self::webhookResponse(), 201);

        $result = $this->client->webhooks->create(
            events: ['string'],
            url: 'https://example.com',
            requestOptions: $this->options(),
        );

        // The service sends the default `enabled` value of the API specification.
        $this->assertRequest(
            'POST',
            '/api/webhooks/',
            body: ['events' => ['string'], 'url' => 'https://example.com', 'enabled' => true],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
        $this->assertSame('webhook_id', $result->id);
        $this->assertSame('https://example.com', $result->url);
        $this->assertSame(['string'], $result->events);
        $this->assertSame('whsec_123', $result->secret);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $this->http->queueJson(self::webhookResponse(), 201);

        $result = $this->client->webhooks->create(
            events: ['string'],
            url: 'https://example.com',
            enabled: true,
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'POST',
            '/api/webhooks/',
            body: ['events' => ['string'], 'url' => 'https://example.com', 'enabled' => true],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
        $this->assertSame('webhook_id', $result->id);
        $this->assertTrue($result->enabled);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson(self::webhookResponse());

        $result = $this->client->webhooks->retrieve(
            'webhook_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/webhooks/webhook_id');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
        $this->assertSame('webhook_id', $result->id);
        $this->assertSame('https://example.com', $result->url);
    }

    #[Test]
    public function testUpdate(): void
    {
        $this->http->queueJson(self::webhookResponse(['enabled' => false]));

        $result = $this->client->webhooks->update(
            'webhook_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('PUT', '/api/webhooks/webhook_id', body: []);
        $this->assertSame('{}', (string) $this->http->requests[0]->getBody());
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
        $this->assertSame('webhook_id', $result->id);
        $this->assertFalse($result->enabled);
    }

    #[Test]
    public function testList(): void
    {
        $this->http->queueJson([
            self::webhookResponse(),
            self::webhookResponse(['id' => 'webhook_id_2', 'enabled' => false]),
        ]);

        $result = $this->client->webhooks->list(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/webhooks/');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(WebhookResponse::class, $result);
        $this->assertSame('webhook_id', $result[0]->id);
        $this->assertSame('webhook_id_2', $result[1]->id);
        $this->assertFalse($result[1]->enabled);
    }

    #[Test]
    public function testDelete(): void
    {
        $this->http->queueJson(['is_deleted' => true]);

        $result = $this->client->webhooks->delete(
            'webhook_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('DELETE', '/api/webhooks/webhook_id');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDeleteResponse::class, $result);
        $this->assertTrue($result->isDeleted);
    }

    #[Test]
    public function testRetrieveHistory(): void
    {
        $this->http->queueJson([
            'history' => [
                ['event_type' => 'document.received', 'status_code' => 200, 'success' => true],
            ],
        ]);

        $result = $this->client->webhooks->retrieveHistory(
            'webhook_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/webhooks/webhook_id/history');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookGetHistoryResponse::class, $result);
        $this->assertSame(
            [['event_type' => 'document.received', 'status_code' => 200, 'success' => true]],
            $result->history,
        );
    }

    #[Test]
    public function testTest(): void
    {
        $this->http->queueJson(self::testResponse());

        $result = $this->client->webhooks->test(
            'webhook_id',
            data: ['foo' => 'bar'],
            eventType: 'event_type',
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'POST',
            '/api/webhooks/webhook_id/test',
            body: ['data' => ['foo' => 'bar'], 'event_type' => 'event_type'],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTestResponse::class, $result);
        $this->assertTrue($result->success);
        $this->assertSame('Test event sent', $result->message);
    }

    #[Test]
    public function testTestWithOptionalParams(): void
    {
        $this->http->queueJson(self::testResponse());

        $result = $this->client->webhooks->test(
            'webhook_id',
            data: ['foo' => 'bar'],
            eventType: 'event_type',
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'POST',
            '/api/webhooks/webhook_id/test',
            body: ['data' => ['foo' => 'bar'], 'event_type' => 'event_type'],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTestResponse::class, $result);
        $this->assertSame(
            ['status_code' => 200, 'duration_ms' => 42],
            $result->webhookDeliveryResult,
        );
    }

    /**
     * @param array<string,mixed> $overrides
     *
     * @return array<string,mixed>
     */
    private static function webhookResponse(array $overrides = []): array
    {
        return [
            'id' => 'webhook_id',
            'events' => ['string'],
            'secret' => 'whsec_123',
            'url' => 'https://example.com',
            'enabled' => true,
            ...$overrides,
        ];
    }

    /**
     * @return array<string,mixed>
     */
    private static function testResponse(): array
    {
        return [
            'message' => 'Test event sent',
            'success' => true,
            'webhook_delivery_result' => ['status_code' => 200, 'duration_ms' => 42],
        ];
    }
}
