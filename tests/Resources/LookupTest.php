<?php

namespace Tests\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Lookup\LookupRetrieveParams;
use EInvoiceAPI\Lookup\LookupRetrieveParticipantsParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class LookupTest extends TestCase
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = LookupRetrieveParams::from(peppolID: 'peppol_id');
        $result = $this->client->lookup->retrieve($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = LookupRetrieveParams::from(peppolID: 'peppol_id');
        $result = $this->client->lookup->retrieve($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveParticipants(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = LookupRetrieveParticipantsParams::from(query: 'query');
        $result = $this->client->lookup->retrieveParticipants($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveParticipantsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = LookupRetrieveParticipantsParams::from(
            query: 'query',
            countryCode: 'country_code'
        );
        $result = $this->client->lookup->retrieveParticipants($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
