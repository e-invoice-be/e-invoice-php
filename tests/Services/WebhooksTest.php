<?php

namespace Tests\Services;

use EInvoiceAPI\Core\Exceptions\NotFoundException;
use EInvoiceAPI\Core\Exceptions\UnprocessableEntityException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Services\WebhooksService;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookGetHistoryResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookTestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
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
    public function testUpdateWithOptionalParams(): void
    {
        $this->http->queueJson(self::webhookResponse([
            'events' => ['document.sent'],
            'url' => 'https://example.com/hook',
            'enabled' => false,
        ]));

        $result = $this->client->webhooks->update(
            'webhook_id',
            enabled: false,
            events: ['document.sent'],
            url: 'https://example.com/hook',
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'PUT',
            '/api/webhooks/webhook_id',
            body: ['enabled' => false, 'events' => ['document.sent'], 'url' => 'https://example.com/hook'],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
        $this->assertSame(['document.sent'], $result->events);
        $this->assertSame('https://example.com/hook', $result->url);
        $this->assertFalse($result->enabled);
    }

    #[Test]
    public function testUpdateSendsAnExplicitNull(): void
    {
        $this->http->queueJson(self::webhookResponse());

        $this->client->webhooks->update(
            'webhook_id',
            enabled: null,
            events: null,
            url: null,
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'PUT',
            '/api/webhooks/webhook_id',
            body: ['enabled' => null, 'events' => null, 'url' => null],
        );
        $this->assertSame(
            '{"enabled":null,"events":null,"url":null}',
            (string) $this->http->requests[0]->getBody(),
        );
    }

    #[Test]
    public function testUpdateOmitsOnlyTheParamsLeftOut(): void
    {
        $this->http->queueJson(self::webhookResponse());

        $this->client->webhooks->update(
            'webhook_id',
            url: null,
            requestOptions: $this->options(),
        );

        $this->assertSame('{"url":null}', (string) $this->http->requests[0]->getBody());
    }

    #[Test]
    public function testResponseWithoutEnabledIsParsed(): void
    {
        // `enabled` is not in the `required` list of `WebhookResponse`.
        $response = self::webhookResponse();
        unset($response['enabled']);
        $this->http->queueJson($response);

        $result = $this->client->webhooks->retrieve('webhook_id', requestOptions: $this->options());

        $this->assertSame('webhook_id', $result->id);
        $this->assertNull($result->enabled);
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
     * @param \Closure(WebhooksService, RequestOptions): mixed $call
     * @param array<string,mixed>|null $body
     */
    #[Test]
    #[DataProvider('callsOfAnUnknownWebhook')]
    public function testUnknownWebhookThrowsNotFound(\Closure $call, string $method, string $path, ?array $body): void
    {
        // The 404 of these operations is an `ErrorResponse`.
        $this->http->queueJson(['detail' => 'Webhook not found'], 404);

        try {
            $call($this->client->webhooks, $this->options());
            $this->fail('The client did not throw.');
        } catch (NotFoundException $e) {
            $this->assertSame(404, $e->status);
            $this->assertSame(['detail' => 'Webhook not found'], $e->body);
        }

        $this->assertRequest($method, $path, body: $body);
    }

    /**
     * @return iterable<string,array{\Closure(WebhooksService, RequestOptions): mixed, string, string, array<string,mixed>|null}>
     */
    public static function callsOfAnUnknownWebhook(): iterable
    {
        yield 'retrieve' => [
            static fn (WebhooksService $s, RequestOptions $o) => $s->retrieve('webhook_id', requestOptions: $o),
            'GET',
            '/api/webhooks/webhook_id',
            null,
        ];

        yield 'update' => [
            static fn (WebhooksService $s, RequestOptions $o) => $s->update('webhook_id', enabled: false, requestOptions: $o),
            'PUT',
            '/api/webhooks/webhook_id',
            ['enabled' => false],
        ];

        yield 'delete' => [
            static fn (WebhooksService $s, RequestOptions $o) => $s->delete('webhook_id', requestOptions: $o),
            'DELETE',
            '/api/webhooks/webhook_id',
            null,
        ];

        yield 'test' => [
            static fn (WebhooksService $s, RequestOptions $o) => $s->test('webhook_id', data: [], eventType: 'document.received', requestOptions: $o),
            'POST',
            '/api/webhooks/webhook_id/test',
            ['data' => [], 'event_type' => 'document.received'],
        ];
    }

    /**
     * @param \Closure(WebhooksService, RequestOptions): mixed $call
     * @param array<string,mixed>|null $body
     */
    #[Test]
    #[DataProvider('callsWithInvalidWebhookData')]
    public function testInvalidWebhookDataThrowsUnprocessableEntity(\Closure $call, string $method, string $path, ?array $body): void
    {
        // The 422 of `POST /api/webhooks/`, `PUT /api/webhooks/{webhook_id}` and
        // `POST /api/webhooks/{webhook_id}/test` is an `ErrorResponse`, not an
        // `HTTPValidationError`.
        $this->http->queueJson(['detail' => 'Invalid webhook data'], 422);

        try {
            $call($this->client->webhooks, $this->options());
            $this->fail('The client did not throw.');
        } catch (UnprocessableEntityException $e) {
            $this->assertSame(422, $e->status);
            $this->assertSame(['detail' => 'Invalid webhook data'], $e->body);
        }

        $this->assertRequest($method, $path, body: $body);
    }

    /**
     * @return iterable<string,array{\Closure(WebhooksService, RequestOptions): mixed, string, string, array<string,mixed>|null}>
     */
    public static function callsWithInvalidWebhookData(): iterable
    {
        yield 'create' => [
            static fn (WebhooksService $s, RequestOptions $o) => $s->create(events: [], url: 'not a url', requestOptions: $o),
            'POST',
            '/api/webhooks/',
            ['events' => [], 'url' => 'not a url', 'enabled' => true],
        ];

        yield 'update' => [
            static fn (WebhooksService $s, RequestOptions $o) => $s->update('webhook_id', url: 'not a url', requestOptions: $o),
            'PUT',
            '/api/webhooks/webhook_id',
            ['url' => 'not a url'],
        ];

        yield 'test' => [
            static fn (WebhooksService $s, RequestOptions $o) => $s->test('webhook_id', data: [], eventType: 'not.an.event', requestOptions: $o),
            'POST',
            '/api/webhooks/webhook_id/test',
            ['data' => [], 'event_type' => 'not.an.event'],
        ];
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
