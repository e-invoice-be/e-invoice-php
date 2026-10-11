<?php

namespace Tests\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Stats\StatGetResponse;
use EInvoiceAPI\Stats\StatGetResponse\Action;
use EInvoiceAPI\Stats\StatRetrieveParams\Aggregation;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class StatsTest extends TestCase
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

        $result = $this->client->stats->retrieve();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(StatGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->stats->retrieve(
            aggregation: Aggregation::MONTH,
            endDate: '2019-12-27',
            startDate: '2019-12-01'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(StatGetResponse::class, $result);
        $this->assertContainsOnlyInstancesOf(Action::class, $result->actions);
        $this->assertContains($result->aggregation, ['DAY', 'WEEK', 'MONTH']);
    }

    #[Test]
    public function testRetrieveReturnsDates(): void
    {
        $transporter = new class() implements ClientInterface {
            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $body = '{"tenant_id":"ten_1","period_start":"2024-01-01","period_end":"2024-01-31","aggregation":"DAY","actions":[{"action":"DOCUMENT_SENT","stat_date":"2024-01-15","count":2}],"total_days":31,"average_daily_usage":0.06}';

                return new Response(200, ['Content-Type' => 'application/json'], $body);
            }
        };

        $result = $this->client->stats->retrieve(
            requestOptions: RequestOptions::with(transporter: $transporter)
        );

        $this->assertSame('2024-01-01', $result->periodStart->format('Y-m-d'));
        $this->assertSame('2024-01-31', $result->periodEnd->format('Y-m-d'));
        $this->assertSame('2024-01-15', $result->actions[0]->statDate->format('Y-m-d'));
    }
}
