<?php

namespace Tests\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Parameters\ValidateValidateJsonParam;
use EInvoiceAPI\Parameters\ValidateValidatePeppolIDParam;
use EInvoiceAPI\Parameters\ValidateValidateUblParam;
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
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->validate
            ->validateJson(new ValidateValidateJsonParam())
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidatePeppolID(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->validate
            ->validatePeppolID(
                new ValidateValidatePeppolIDParam(peppolID: 'peppol_id')
            )
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidatePeppolIDWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->validate
            ->validatePeppolID(
                new ValidateValidatePeppolIDParam(peppolID: 'peppol_id')
            )
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidateUbl(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->validate
            ->validateUbl(new ValidateValidateUblParam(file: 'file'))
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidateUblWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->validate
            ->validateUbl(new ValidateValidateUblParam(file: 'file'))
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
