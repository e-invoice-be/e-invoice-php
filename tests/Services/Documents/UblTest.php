<?php

namespace Tests\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class UblTest extends TestCase
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
    public function testCreateFromUbl(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->documents->ubl->createFromUbl([
            'file' => file_get_contents(__FILE__) ?: '',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
    }

    #[Test]
    public function testCreateFromUblWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->documents->ubl->createFromUbl([
            'file' => file_get_contents(__FILE__) ?: '',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->documents->ubl->get('document_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblGetResponse::class, $result);
    }
}
