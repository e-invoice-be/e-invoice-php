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
final class DraftsTest extends ServiceTestCase
{
    #[Test]
    public function testList(): void
    {
        $this->http->queueJson([
            'items' => [
                [
                    'id' => 'doc_1',
                    'created_at' => '2024-01-15T10:30:00Z',
                    'state' => 'DRAFT',
                ],
                [
                    'id' => 'doc_2',
                    'created_at' => '2024-01-16T10:30:00Z',
                    'state' => 'DRAFT',
                ],
            ],
            'page' => 1,
            'page_size' => 20,
            'pages' => 1,
            'total' => 2,
            'has_next_page' => false,
        ]);

        $page = $this->client->drafts->list(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/drafts/', query: [
            'page' => '1',
            'page_size' => '20',
            'sort_by' => 'created_at',
            'sort_order' => 'desc',
        ]);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);
        $this->assertSame(2, $page->total);
        $this->assertFalse($page->hasNextPage);

        $items = $page->getItems();
        $this->assertCount(2, $items);
        $this->assertContainsOnlyInstancesOf(DocumentResponse::class, $items);
        $this->assertSame('doc_1', $items[0]->id);
        $this->assertSame('doc_2', $items[1]->id);
        $this->assertSame('DRAFT', $items[0]->state);
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $this->http->queueJson([
            'items' => [
                [
                    'id' => 'doc_1',
                    'created_at' => '2024-01-15T10:30:00Z',
                    'state' => 'DRAFT',
                    'document_type' => 'INVOICE',
                ],
            ],
            'page' => 1,
            'page_size' => 1,
            'pages' => 1,
            'total' => 1,
            'has_next_page' => false,
        ]);

        $page = $this->client->drafts->list(
            dateFrom: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            dateTo: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            page: 1,
            pageSize: 1,
            search: 'search',
            sortBy: 'invoice_date',
            sortOrder: 'asc',
            state: 'DRAFT',
            type: 'INVOICE',
            requestOptions: $this->options(),
        );

        // The SDK formats a date-time as RFC 3339 with a precision of one second.
        $this->assertRequest('GET', '/api/drafts/', query: [
            'date_from' => '2019-12-27T18:11:19+00:00',
            'date_to' => '2019-12-27T18:11:19+00:00',
            'page' => '1',
            'page_size' => '1',
            'search' => 'search',
            'sort_by' => 'invoice_date',
            'sort_order' => 'asc',
            'state' => 'DRAFT',
            'type' => 'INVOICE',
        ]);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);
        $this->assertSame(1, $page->pageSize);

        $items = $page->getItems();
        $this->assertCount(1, $items);
        $this->assertContainsOnlyInstancesOf(DocumentResponse::class, $items);
        $this->assertSame('doc_1', $items[0]->id);
        $this->assertSame('INVOICE', $items[0]->documentType);
    }
}
