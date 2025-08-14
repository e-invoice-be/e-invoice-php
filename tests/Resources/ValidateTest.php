<?php

namespace Tests\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Validate\ValidateValidateJsonParams;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDParams;
use EInvoiceAPI\Validate\ValidateValidateUblParams;
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

        $params = (new ValidateValidateJsonParams);
        $result = $this->client->validate->validateJson($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidatePeppolID(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = ValidateValidatePeppolIDParams::with(peppolID: 'peppol_id');
        $result = $this->client->validate->validatePeppolID($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidatePeppolIDWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = ValidateValidatePeppolIDParams::with(peppolID: 'peppol_id');
        $result = $this->client->validate->validatePeppolID($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidateUbl(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = ValidateValidateUblParams::with(file: 'file');
        $result = $this->client->validate->validateUbl($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidateUblWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = ValidateValidateUblParams::with(file: 'file');
        $result = $this->client->validate->validateUbl($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
