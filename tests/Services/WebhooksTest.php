<?php

namespace Tests\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookGetHistoryResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookTestResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class WebhooksTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->create(
            events: ['string'],
            url: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->create(
            events: ['string'],
            url: 'https://example.com',
            enabled: true
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->retrieve('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->update('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->delete('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDeleteResponse::class, $result);
    }

    #[Test]
    public function testRetrieveHistory(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->retrieveHistory('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookGetHistoryResponse::class, $result);
    }

    #[Test]
    public function testTest(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->test(
            'webhook_id',
            data: ['foo' => 'bar'],
            eventType: 'event_type'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTestResponse::class, $result);
    }

    #[Test]
    public function testTestWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webhooks->test(
            'webhook_id',
            data: ['foo' => 'bar'],
            eventType: 'event_type'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTestResponse::class, $result);
    }
}
