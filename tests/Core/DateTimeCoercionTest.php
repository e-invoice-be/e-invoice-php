<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Me\MeGetResponse;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DateTimeTestModel implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    /** @var list<\DateTimeInterface> */
    #[Required(list: \DateTimeInterface::class)]
    public array $dates;

    /** @var list<\DateTimeInterface|null>|null */
    #[Optional('nullable_dates', type: new ListOf(\DateTimeInterface::class, nullable: true), nullable: true)]
    public ?array $nullableDates;

    #[Optional]
    public \DateTimeInterface|int|null $either;

    #[Optional]
    public ?\DateTime $mutable;

    public function __construct()
    {
        $this->initialize();
    }
}

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversNothing]
class DateTimeCoercionTest extends TestCase
{
    #[Test]
    public function testDateTimeStringIsCoercedOnAResponseModel(): void
    {
        /** @var MeGetResponse $me */
        $me = Conversion::coerce(
            MeGetResponse::class,
            value: ['name' => 'Acme', 'smp_registration_date' => '2024-01-31T10:15:30+02:00'],
        );

        $this->assertInstanceOf(\DateTimeInterface::class, $me->smpRegistrationDate);
        $this->assertSame('2024-01-31T10:15:30+02:00', $me->smpRegistrationDate->format(\DateTimeInterface::RFC3339));
    }

    #[Test]
    public function testDateStringIsCoerced(): void
    {
        /** @var DocumentResponse $document */
        $document = Conversion::coerce(
            DocumentResponse::class,
            value: ['id' => 'doc_1', 'created_at' => '2024-01-31T10:15:30.123456Z', 'invoice_date' => '2024-01-31', 'due_date' => null],
        );

        $this->assertInstanceOf(\DateTimeInterface::class, $document->createdAt);
        $this->assertSame('2024-01-31T10:15:30.123456+00:00', $document->createdAt->format('Y-m-d\TH:i:s.uP'));
        $this->assertInstanceOf(\DateTimeInterface::class, $document->invoiceDate);
        $this->assertSame('2024-01-31T00:00:00+00:00', $document->invoiceDate->format(\DateTimeInterface::RFC3339));
        $this->assertNull($document->dueDate);
    }

    #[Test]
    public function testDateTimeWithoutOffsetIsReadAsUtc(): void
    {
        $zone = date_default_timezone_get();
        date_default_timezone_set('America/New_York');

        try {
            /** @var MeGetResponse $me */
            $me = Conversion::coerce(MeGetResponse::class, value: ['name' => 'Acme', 'smp_registration_date' => '2024-01-31T10:15:30']);
        } finally {
            date_default_timezone_set($zone);
        }

        $this->assertSame('2024-01-31T10:15:30+00:00', $me->smpRegistrationDate?->format(\DateTimeInterface::RFC3339));
    }

    #[Test]
    public function testDatesInsideListsAndNestedModelsAreCoerced(): void
    {
        /** @var DateTimeTestModel $model */
        $model = Conversion::coerce(
            DateTimeTestModel::class,
            value: [
                'dates' => ['2024-01-31', '2024-02-01T00:00:00Z'],
                'nullable_dates' => [null, '2024-01-31'],
                'either' => '2024-01-31',
                'mutable' => '2024-01-31',
            ],
        );

        $this->assertContainsOnlyInstancesOf(\DateTimeInterface::class, $model->dates);
        $this->assertNull($model->nullableDates[0] ?? null);
        $this->assertInstanceOf(\DateTimeInterface::class, $model->nullableDates[1] ?? null);
        $this->assertInstanceOf(\DateTimeInterface::class, $model->either);
        $this->assertInstanceOf(\DateTime::class, $model->mutable);

        /** @var DocumentGetTimelineResponse $timeline */
        $timeline = Conversion::coerce(
            DocumentGetTimelineResponse::class,
            value: ['document_id' => 'doc_1', 'events' => [['event_type' => 'sent', 'timestamp' => '2024-01-31T10:15:30Z']]],
        );

        $this->assertSame('2024-01-31', $timeline->events[0]->timestamp->format('Y-m-d'));
    }

    #[Test]
    public function testInvalidDateStringsAreKeptAsRawPayload(): void
    {
        foreach (['not a date', '', 'tomorrow', '2024-02-30', '2024-13-01T00:00:00Z', '2024-01-31garbage'] as $raw) {
            /** @var MeGetResponse $me */
            $me = Conversion::coerce(MeGetResponse::class, value: ['name' => 'Acme', 'smp_registration_date' => $raw]);

            $this->assertSame('Acme', $me->name);
            $this->assertSame($raw, $me['smpRegistrationDate']);
        }

        /** @var DateTimeTestModel $model */
        $model = Conversion::coerce(DateTimeTestModel::class, value: ['dates' => [], 'either' => 12, 'mutable' => 12]);
        $this->assertSame(12, $model->either);
        $this->assertSame(12, $model['mutable']);
    }

    #[Test]
    public function testCoercedDatesAreSerializedAgain(): void
    {
        /** @var MeGetResponse $me */
        $me = Conversion::coerce(MeGetResponse::class, value: ['name' => 'Acme', 'smp_registration_date' => '2024-01-31T10:15:30Z']);

        $this->assertStringContainsString('"smp_registration_date":"2024-01-31T10:15:30+00:00"', json_encode($me) ?: '');
    }

    #[Test]
    public function testDatesAreCoercedOnAClientResponse(): void
    {
        $transporter = new class() implements ClientInterface {
            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $body = ['name' => 'Acme', 'smp_registration_date' => '2024-01-31T10:15:30Z'];

                return new Response(200, ['Content-Type' => 'application/json'], json_encode($body) ?: '');
            }
        };

        $me = (new Client(apiKey: 'My API Key', baseUrl: 'http://localhost'))
            ->me
            ->retrieve(requestOptions: RequestOptions::with(transporter: $transporter))
        ;

        $this->assertSame('2024-01-31', $me->smpRegistrationDate?->format('Y-m-d'));
    }
}
