<?php

namespace Tests\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class OutboxTest extends TestCase
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
    public function testListDraftDocuments(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = (new OutboxListDraftDocumentsParams);
        $result = $this->client->outbox->listDraftDocuments($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testListReceivedDocuments(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = (new OutboxListReceivedDocumentsParams);
        $result = $this->client->outbox->listReceivedDocuments($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
