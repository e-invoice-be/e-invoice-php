<?php

namespace Tests\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ValidateTest extends TestCase
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
    public function testValidateJson(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->validate->validateJson([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
    }

    #[Test]
    public function testValidatePeppolID(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->validate->validatePeppolID([
            'peppol_id' => 'peppol_id',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ValidateValidatePeppolIDResponse::class, $result);
    }

    #[Test]
    public function testValidatePeppolIDWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->validate->validatePeppolID([
            'peppol_id' => 'peppol_id',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ValidateValidatePeppolIDResponse::class, $result);
    }

    #[Test]
    public function testValidateUbl(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->validate->validateUbl([
            'file' => file_get_contents(__FILE__) ?: '',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
    }

    #[Test]
    public function testValidateUblWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->validate->validateUbl([
            'file' => file_get_contents(__FILE__) ?: '',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
    }
}
