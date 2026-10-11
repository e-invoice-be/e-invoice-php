<?php

namespace Tests\Services;

use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
#[CoversNothing]
final class OutboxTest extends ServiceTestCase
{
    private const DEFAULT_QUERY = [
        'page' => '1',
        'page_size' => '20',
        'sort_by' => 'created_at',
        'sort_order' => 'desc',
    ];

    #[Test]
    public function testListDraftDocuments(): void
    {
        $this->queuePage('doc_1', 'DRAFT');

        $page = $this->client->outbox->listDraftDocuments(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/outbox/drafts', self::DEFAULT_QUERY);
        $this->assertPage($page, 'doc_1', 'DRAFT');
    }

    #[Test]
    public function testListDraftDocumentsWithOptionalParams(): void
    {
        $this->queuePage('doc_2', 'DRAFT');

        $page = $this->client->outbox->listDraftDocuments(
            page: 1,
            pageSize: 1,
            search: 'search',
            sortBy: 'invoice_date',
            sortOrder: 'asc',
            state: 'DRAFT',
            type: 'INVOICE',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/outbox/drafts', [
            'page' => '1',
            'page_size' => '1',
            'search' => 'search',
            'sort_by' => 'invoice_date',
            'sort_order' => 'asc',
            'state' => 'DRAFT',
            'type' => 'INVOICE',
        ]);
        $this->assertPage($page, 'doc_2', 'DRAFT');
    }

    #[Test]
    public function testListReceivedDocuments(): void
    {
        $this->queuePage('doc_3', 'SENT');

        $page = $this->client->outbox->listReceivedDocuments(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/outbox/', self::DEFAULT_QUERY);
        $this->assertPage($page, 'doc_3', 'SENT');
    }

    #[Test]
    public function testListReceivedDocumentsWithOptionalParams(): void
    {
        $this->queuePage('doc_4', 'SENT');

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
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/outbox/', [
            'date_from' => '2019-12-27T18:11:19+00:00',
            'date_to' => '2019-12-27T18:11:19+00:00',
            'page' => '1',
            'page_size' => '1',
            'receiver' => 'receiver',
            'search' => 'search',
            'sender' => 'sender',
            'sort_by' => 'invoice_date',
            'sort_order' => 'asc',
            'type' => 'INVOICE',
        ]);
        $this->assertPage($page, 'doc_4', 'SENT');
    }

    #[Test]
    public function testListReceivedDocumentsSendsQueryParamsWithTheirApiNames(): void
    {
        $this->http->queueJson(['items' => []]);

        $page = $this->client->outbox->listReceivedDocuments(
            receiver: 'acme',
            sortOrder: 'asc',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/outbox/', [
            'page' => '1',
            'page_size' => '20',
            'receiver' => 'acme',
            'sort_by' => 'created_at',
            'sort_order' => 'asc',
        ]);
        $this->assertSame([], $page->getItems());
    }

    private function queuePage(string $id, string $state): void
    {
        $this->http->queueJson([
            'items' => [
                [
                    'id' => $id,
                    'created_at' => '2024-01-15T10:00:00Z',
                    'direction' => 'OUTBOUND',
                    'document_type' => 'INVOICE',
                    'state' => $state,
                    'invoice_id' => 'INV-2024-001',
                    'invoice_total' => '121.00',
                    'currency' => 'EUR',
                ],
            ],
            'total' => 1,
            'page' => 1,
            'page_size' => 20,
            'pages' => 1,
            'has_next_page' => false,
        ]);
    }

    /**
     * @param DocumentsNumberPage<DocumentResponse> $page
     */
    private function assertPage(DocumentsNumberPage $page, string $id, string $state): void
    {
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);
        $this->assertSame(1, $page->total);
        $this->assertFalse($page->hasNextPage);

        $items = $page->getItems();
        $this->assertCount(1, $items);
        $item = $items[0];
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $item);
        $this->assertSame($id, $item->id);
        $this->assertSame('2024-01-15', $item->createdAt->format('Y-m-d'));
        $this->assertSame('OUTBOUND', $item->direction);
        $this->assertSame('INVOICE', $item->documentType);
        $this->assertSame($state, $item->state);
        $this->assertSame('INV-2024-001', $item->invoiceID);
        $this->assertSame('121.00', $item->invoiceTotal);
    }
}
