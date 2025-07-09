<?php

namespace EInvoiceAPI\Tests\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Models\DocumentResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class InboxTest extends TestCase
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
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this->client->inbox->list([]);

        $this->assertInstanceOf(DocumentResponse::class, $result);
    }

    #[Test]
    public function testListCreditNotes(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this->client->inbox->listCreditNotes([]);

        $this->assertInstanceOf(DocumentResponse::class, $result);
    }

    #[Test]
    public function testListInvoices(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this->client->inbox->listInvoices([]);

        $this->assertInstanceOf(DocumentResponse::class, $result);
    }
}
