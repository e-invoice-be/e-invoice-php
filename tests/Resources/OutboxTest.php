<?php

namespace Tests\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Parameters\OutboxListDraftDocumentsParam;
use EInvoiceAPI\Parameters\OutboxListReceivedDocumentsParam;
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
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->outbox
            ->listDraftDocuments(new OutboxListDraftDocumentsParam())
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testListReceivedDocuments(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->outbox
            ->listReceivedDocuments(new OutboxListReceivedDocumentsParam())
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
