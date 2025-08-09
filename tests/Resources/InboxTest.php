<?php

namespace Tests\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Models\InboxListCreditNotesParams;
use EInvoiceAPI\Models\InboxListInvoicesParams;
use EInvoiceAPI\Models\InboxListParams;
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

        $result = $this->client->inbox->list(new InboxListParams);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testListCreditNotes(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->inbox
            ->listCreditNotes(new InboxListCreditNotesParams)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testListInvoices(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this->client->inbox->listInvoices(new InboxListInvoicesParams);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
