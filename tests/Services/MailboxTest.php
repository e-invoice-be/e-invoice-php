<?php

namespace Tests\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Mailbox\InboundEmailResponse;
use EInvoiceAPI\RequestOptions;
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
final class MailboxTest extends TestCase
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

        $result = $this->client->mailbox->retrieve('inbound_email_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundEmailResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->mailbox->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(InboundEmailResponse::class, $item);
        }
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->mailbox->list(
            page: 1,
            pageSize: 1,
            processed: true,
            receivedFrom: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            receivedTo: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            search: 'search',
            sortBy: 'created_at',
            sortOrder: 'asc',
            status: 'pending',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(InboundEmailResponse::class, $item);
        }
    }

    #[Test]
    public function testListSendsQueryParamsWithTheirApiNames(): void
    {
        $transporter = new class() implements ClientInterface {
            public ?RequestInterface $request = null;

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $this->request = $request;

                return new Response(200, ['Content-Type' => 'application/json'], '{"items":[]}');
            }
        };

        $this->client->mailbox->list(
            processed: false,
            receivedFrom: new \DateTimeImmutable('2019-12-27T18:11:19+00:00'),
            sortBy: 'created_at',
            status: 'failed',
            requestOptions: RequestOptions::with(transporter: $transporter),
        );

        parse_str($transporter->request?->getUri()->getQuery() ?? '', $query);
        $this->assertSame(
            [
                'page' => '1',
                'page_size' => '20',
                'processed' => 'false',
                'received_from' => '2019-12-27T18:11:19+00:00',
                'sort_by' => 'created_at',
                'sort_order' => 'desc',
                'status' => 'failed',
            ],
            $query,
        );
    }

    #[Test]
    public function testDownloadAttachment(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->mailbox->downloadAttachment(
            'filename',
            inboundEmailID: 'inbound_email_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testReprocess(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->mailbox->reprocess('inbound_email_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundEmailResponse::class, $result);
    }
}
