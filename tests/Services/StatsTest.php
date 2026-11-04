<?php

namespace Tests\Services;

use EInvoiceAPI\Stats\StatGetResponse;
use EInvoiceAPI\Stats\StatGetResponse\Action;
use EInvoiceAPI\Stats\StatRetrieveParams;
use EInvoiceAPI\Stats\StatRetrieveParams\Aggregation;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
final class StatsTest extends ServiceTestCase
{
    private const STATS = [
        'tenant_id' => 'ten_1',
        'period_start' => '2024-01-01',
        'period_end' => '2024-01-31',
        'aggregation' => 'DAY',
        'actions' => [
            ['action' => 'DOCUMENT_SENT', 'stat_date' => '2024-01-15', 'count' => 2],
        ],
        'total_days' => 31,
        'average_daily_usage' => 0.06,
    ];

    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson(self::STATS);

        $result = $this->client->stats->retrieve(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/stats', ['aggregation' => 'DAY']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(StatGetResponse::class, $result);
        $this->assertSame('ten_1', $result->tenantID);
        $this->assertSame('DAY', $result->aggregation);
        $this->assertSame(31, $result->totalDays);
        $this->assertSame(0.06, $result->averageDailyUsage);
        $this->assertNull($result->budgetEstimationDays);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $this->http->queueJson([
            'tenant_id' => 'ten_1',
            'period_start' => '2019-12-01',
            'period_end' => '2019-12-27',
            'aggregation' => 'MONTH',
            'actions' => [
                ['action' => 'DOCUMENT_SENT', 'stat_date' => '2019-12-01', 'count' => 5],
                ['action' => 'DOCUMENT_RECEIVED', 'stat_date' => '2019-12-01', 'count' => 3],
            ],
            'total_days' => 27,
            'average_daily_usage' => 0.3,
            'budget_estimation_days' => 120.5,
        ]);

        $result = $this->client->stats->retrieve(
            aggregation: Aggregation::MONTH,
            endDate: '2019-12-27',
            startDate: '2019-12-01',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/stats', [
            'aggregation' => 'MONTH',
            'end_date' => '2019-12-27',
            'start_date' => '2019-12-01',
        ]);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(StatGetResponse::class, $result);
        $this->assertCount(2, $result->actions);
        $this->assertContainsOnlyInstancesOf(Action::class, $result->actions);
        $this->assertSame('MONTH', $result->aggregation);
        $this->assertSame('DOCUMENT_RECEIVED', $result->actions[1]->action);
        $this->assertSame(3, $result->actions[1]->count);
        $this->assertSame(120.5, $result->budgetEstimationDays);
    }

    #[Test]
    public function testRetrieveReturnsDates(): void
    {
        $this->http->queueJson(self::STATS);

        $result = $this->client->stats->retrieve(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/stats', ['aggregation' => 'DAY']);
        $this->assertSame('2024-01-01', $result->periodStart->format('Y-m-d'));
        $this->assertSame('2024-01-31', $result->periodEnd->format('Y-m-d'));
        $this->assertSame('2024-01-15', $result->actions[0]->statDate->format('Y-m-d'));
    }

    #[Test]
    public function testRetrieveSendsDateObjectsAsDates(): void
    {
        $this->http->queueJson(self::STATS);

        $this->client->stats->retrieve(
            endDate: new \DateTimeImmutable('2019-12-27T23:30:15.5+02:00'),
            startDate: new \DateTime('2019-12-01'),
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/stats', [
            'aggregation' => 'DAY',
            'end_date' => '2019-12-27',
            'start_date' => '2019-12-01',
        ]);
    }

    #[Test]
    public function testRetrieveSendsDateStringsVerbatim(): void
    {
        $this->http->queueJson(self::STATS);

        $this->client->stats->retrieve(
            endDate: '2019-12-27',
            startDate: 'not-a-date',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/stats', [
            'aggregation' => 'DAY',
            'end_date' => '2019-12-27',
            'start_date' => 'not-a-date',
        ]);
    }

    #[Test]
    public function testRawRetrieveSendsDateObjectsAsDates(): void
    {
        $this->http->queueJson(self::STATS);
        $this->http->queueJson(self::STATS);

        $this->client->stats->raw->retrieve(
            StatRetrieveParams::with(
                endDate: new \DateTimeImmutable('2019-12-27'),
                startDate: '2019-12-01',
            ),
            requestOptions: $this->options(),
        );
        $this->client->stats->raw->retrieve(
            ['endDate' => new \DateTimeImmutable('2019-12-27'), 'startDate' => null],
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/stats', [
            'end_date' => '2019-12-27',
            'start_date' => '2019-12-01',
        ]);
        $this->assertRequest('GET', '/api/stats', ['end_date' => '2019-12-27'], index: 1);
    }

    #[Test]
    public function testParamsKeepTheDateTheCallerGave(): void
    {
        $date = new \DateTimeImmutable('2019-12-27');
        $params = StatRetrieveParams::with()->withStartDate($date)->withEndDate('2019-12-31');

        $this->assertSame($date, $params->startDate);
        $this->assertSame('2019-12-31', $params->endDate);
        $this->assertSame(['endDate' => '2019-12-31', 'startDate' => '2019-12-27'], $params->jsonSerialize());
    }

    #[Test]
    public function testParamsFromAnArrayKeepDatesAndStringifyScalars(): void
    {
        $date = new \DateTimeImmutable('2019-12-27');
        $params = StatRetrieveParams::fromArray(['startDate' => $date, 'endDate' => 20191231]);

        $this->assertSame($date, $params->startDate);
        $this->assertSame('20191231', $params->endDate);
    }

    #[Test]
    public function testClearedDateIsNotSent(): void
    {
        $this->http->queueJson(self::STATS);
        $params = StatRetrieveParams::with(endDate: new \DateTimeImmutable('2019-12-27'))->withEndDate(null);

        $this->client->stats->raw->retrieve($params, requestOptions: $this->options());

        $this->assertRequest('GET', '/api/stats');
    }

    #[Test]
    public function testParamsSurviveSerialization(): void
    {
        $params = StatRetrieveParams::with(startDate: new \DateTimeImmutable('2019-12-27'));

        $copy = unserialize(serialize($params));

        $this->assertInstanceOf(StatRetrieveParams::class, $copy);
        $this->assertSame(['startDate' => '2019-12-27'], $copy->jsonSerialize());
    }
}
