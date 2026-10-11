<?php

namespace Tests\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Conversion\DocumentCreateFromPdfTask;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ConversionTest extends TestCase
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
    public function testCreateFromPdf(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->conversion->createFromPdf(file: 'file');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentCreateFromPdfTask::class, $result);
    }

    #[Test]
    public function testCreateFromPdfWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->conversion->createFromPdf(file: 'file');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentCreateFromPdfTask::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->conversion->retrieve('task_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentCreateFromPdfTask::class, $result);
    }

    #[Test]
    public function testRetrieveResult(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->conversion->retrieveResult('task_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentNewFromPdfResponse::class, $result);
    }
}
