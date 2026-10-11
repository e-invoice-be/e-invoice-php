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
final class InboxTest extends ServiceTestCase
{
    private const DEFAULT_QUERY = [
        'page' => '1',
        'page_size' => '20',
        'sort_by' => 'created_at',
        'sort_order' => 'desc',
    ];

    #[Test]
    public function testList(): void
    {
        $this->queuePage('doc_1', 'INVOICE');

        $page = $this->client->inbox->list(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/inbox/', self::DEFAULT_QUERY);
        $this->assertPage($page, 'doc_1', 'INVOICE');
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $this->queuePage('doc_2', 'SELFBILLING_INVOICE');

        $page = $this->client->inbox->list(
            dateFrom: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            dateTo: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            page: 1,
            pageSize: 1,
            search: 'search',
            sender: 'sender',
            sortBy: 'invoice_date',
            sortOrder: 'asc',
            type: 'SELFBILLING_INVOICE',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/inbox/', [
            'date_from' => '2019-12-27T18:11:19+00:00',
            'date_to' => '2019-12-27T18:11:19+00:00',
            'page' => '1',
            'page_size' => '1',
            'search' => 'search',
            'sender' => 'sender',
            'sort_by' => 'invoice_date',
            'sort_order' => 'asc',
            'type' => 'SELFBILLING_INVOICE',
        ]);
        $this->assertPage($page, 'doc_2', 'SELFBILLING_INVOICE');
    }

    #[Test]
    public function testListCreditNotes(): void
    {
        $this->queuePage('doc_3', 'CREDIT_NOTE');

        $page = $this->client->inbox->listCreditNotes(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/inbox/credit-notes', self::DEFAULT_QUERY);
        $this->assertPage($page, 'doc_3', 'CREDIT_NOTE');
    }

    #[Test]
    public function testListCreditNotesWithOptionalParams(): void
    {
        $this->queuePage('doc_4', 'CREDIT_NOTE');

        $page = $this->client->inbox->listCreditNotes(
            page: 1,
            pageSize: 1,
            sortBy: 'invoice_date',
            sortOrder: 'asc',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/inbox/credit-notes', [
            'page' => '1',
            'page_size' => '1',
            'sort_by' => 'invoice_date',
            'sort_order' => 'asc',
        ]);
        $this->assertPage($page, 'doc_4', 'CREDIT_NOTE');
    }

    #[Test]
    public function testListInvoices(): void
    {
        $this->queuePage('doc_5', 'INVOICE');

        $page = $this->client->inbox->listInvoices(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/inbox/invoices', self::DEFAULT_QUERY);
        $this->assertPage($page, 'doc_5', 'INVOICE');
    }

    #[Test]
    public function testListInvoicesWithOptionalParams(): void
    {
        $this->queuePage('doc_6', 'INVOICE');

        $page = $this->client->inbox->listInvoices(
            page: 1,
            pageSize: 1,
            sortBy: 'invoice_date',
            sortOrder: 'asc',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/inbox/invoices', [
            'page' => '1',
            'page_size' => '1',
            'sort_by' => 'invoice_date',
            'sort_order' => 'asc',
        ]);
        $this->assertPage($page, 'doc_6', 'INVOICE');
    }

    private function queuePage(string $id, string $documentType): void
    {
        $this->http->queueJson([
            'items' => [
                [
                    'id' => $id,
                    'created_at' => '2024-01-15T10:00:00Z',
                    'direction' => 'INBOUND',
                    'document_type' => $documentType,
                    'state' => 'RECEIVED',
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
    private function assertPage(DocumentsNumberPage $page, string $id, string $documentType): void
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
        $this->assertSame('INBOUND', $item->direction);
        $this->assertSame($documentType, $item->documentType);
        $this->assertSame('RECEIVED', $item->state);
        $this->assertSame('INV-2024-001', $item->invoiceID);
        $this->assertSame('121.00', $item->invoiceTotal);
    }
}
