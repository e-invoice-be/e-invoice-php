<?php

namespace Tests\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
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
final class OutboxTest extends TestCase
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
    public function testListDraftDocuments(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->outbox->listDraftDocuments();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(DocumentResponse::class, $item);
        }
    }

    #[Test]
    public function testListDraftDocumentsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->outbox->listDraftDocuments(
            page: 1,
            pageSize: 1,
            search: 'search',
            sortBy: 'invoice_date',
            sortOrder: 'asc',
            state: 'DRAFT',
            type: 'INVOICE',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(DocumentResponse::class, $item);
        }
    }

    #[Test]
    public function testListReceivedDocuments(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->outbox->listReceivedDocuments();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(DocumentResponse::class, $item);
        }
    }

    #[Test]
    public function testListReceivedDocumentsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->outbox->listReceivedDocuments(
            dateFrom: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            dateTo: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            page: 1,
            pageSize: 1,
            receiver: 'receiver',
            search: 'search',
            sender: 'sender',
            sortBy: 'invoice_date',
            sortOrder: 'asc',
            type: 'INVOICE',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(DocumentResponse::class, $item);
        }
    }

    #[Test]
    public function testListReceivedDocumentsSendsQueryParamsWithTheirApiNames(): void
    {
        $transporter = new class() implements ClientInterface {
            public ?RequestInterface $request = null;

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $this->request = $request;

                return new Response(200, ['Content-Type' => 'application/json'], '{"items":[]}');
            }
        };

        $this->client->outbox->listReceivedDocuments(
            receiver: 'acme',
            sortOrder: 'asc',
            requestOptions: RequestOptions::with(transporter: $transporter),
        );

        parse_str($transporter->request?->getUri()->getQuery() ?? '', $query);
        $this->assertSame(
            ['page' => '1', 'page_size' => '20', 'receiver' => 'acme', 'sort_by' => 'created_at', 'sort_order' => 'asc'],
            $query,
        );
    }
}
