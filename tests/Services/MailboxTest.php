<?php

namespace Tests\Services;

use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Mailbox\InboundEmailResponse;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
#[CoversNothing]
final class MailboxTest extends ServiceTestCase
{
    private const EMAIL = [
        'id' => 'inbound_email_id',
        'created_at' => '2024-01-15T10:00:00Z',
        'message_id' => '<msg-1@example.com>',
        'sender_email' => 'billing@example.com',
        'sender_name' => 'Billing',
        'subject' => 'Invoice INV-2024-001',
        'received_at' => '2024-01-15T09:59:00Z',
        'processed' => true,
        'processed_at' => '2024-01-15T10:01:00Z',
        'document_id' => 'doc_1',
        'attachment_count' => 1,
        'attachments' => [
            ['filename' => 'invoice.pdf', 'content_type' => 'application/pdf', 'size' => 1024],
        ],
    ];

    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson(self::EMAIL);

        $result = $this->client->mailbox->retrieve(
            'inbound_email_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/mailbox/inbound_email_id');
        $this->assertEmail($result);
    }

    #[Test]
    public function testList(): void
    {
        $this->queuePage();

        $page = $this->client->mailbox->list(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/mailbox/', [
            'page' => '1',
            'page_size' => '20',
            'sort_by' => 'received_at',
            'sort_order' => 'desc',
        ]);
        $this->assertPage($page);
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $this->queuePage();

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
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/mailbox/', [
            'page' => '1',
            'page_size' => '1',
            'processed' => 'true',
            'received_from' => '2019-12-27T18:11:19+00:00',
            'received_to' => '2019-12-27T18:11:19+00:00',
            'search' => 'search',
            'sort_by' => 'created_at',
            'sort_order' => 'asc',
            'status' => 'pending',
        ]);
        $this->assertPage($page);
    }

    #[Test]
    public function testListSendsQueryParamsWithTheirApiNames(): void
    {
        $this->http->queueJson(['items' => []]);

        $page = $this->client->mailbox->list(
            processed: false,
            receivedFrom: new \DateTimeImmutable('2019-12-27T18:11:19+00:00'),
            sortBy: 'created_at',
            status: 'failed',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/mailbox/', [
            'page' => '1',
            'page_size' => '20',
            'processed' => 'false',
            'received_from' => '2019-12-27T18:11:19+00:00',
            'sort_by' => 'created_at',
            'sort_order' => 'desc',
            'status' => 'failed',
        ]);
        $this->assertSame([], $page->getItems());
    }

    #[Test]
    public function testDownloadAttachment(): void
    {
        $content = "%PDF-1.4\n\x00\x01binary";
        $this->http->queue(new Response(200, ['Content-Type' => 'application/pdf'], $content));

        $result = $this->client->mailbox->downloadAttachment(
            'filename',
            inboundEmailID: 'inbound_email_id',
            requestOptions: $this->options(),
        );

        $request = $this->assertRequest('GET', '/api/mailbox/inbound_email_id/attachments/filename');
        $this->assertSame('*/*', $request->getHeaderLine('Accept'));
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
        $this->assertSame($content, $result);
    }

    #[Test]
    public function testReprocess(): void
    {
        $this->http->queueJson([...self::EMAIL, 'processed' => false, 'processed_at' => null]);

        $result = $this->client->mailbox->reprocess(
            'inbound_email_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('POST', '/api/mailbox/inbound_email_id/reprocess');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundEmailResponse::class, $result);
        $this->assertSame('inbound_email_id', $result->id);
        $this->assertFalse($result->processed);
        $this->assertNull($result->processedAt);
    }

    private function queuePage(): void
    {
        $this->http->queueJson([
            'items' => [self::EMAIL],
            'total' => 1,
            'page' => 1,
            'page_size' => 20,
            'pages' => 1,
            'has_next_page' => false,
        ]);
    }

    /**
     * @param DocumentsNumberPage<InboundEmailResponse> $page
     */
    private function assertPage(DocumentsNumberPage $page): void
    {
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentsNumberPage::class, $page);
        $this->assertSame(1, $page->total);
        $this->assertFalse($page->hasNextPage);

        $items = $page->getItems();
        $this->assertCount(1, $items);
        $this->assertEmail($items[0]);
    }

    private function assertEmail(mixed $email): void
    {
        $this->assertInstanceOf(InboundEmailResponse::class, $email);
        $this->assertSame('inbound_email_id', $email->id);
        $this->assertSame('2024-01-15T10:00:00+00:00', $email->createdAt->format(\DATE_ATOM));
        $this->assertSame('<msg-1@example.com>', $email->messageID);
        $this->assertSame('billing@example.com', $email->senderEmail);
        $this->assertSame('Invoice INV-2024-001', $email->subject);
        $this->assertTrue($email->processed);
        $this->assertSame('doc_1', $email->documentID);
        $this->assertSame(1, $email->attachmentCount);
        $this->assertNotNull($email->attachments);
        $this->assertCount(1, $email->attachments);
        $this->assertSame('invoice.pdf', $email->attachments[0]->filename);
        $this->assertSame('application/pdf', $email->attachments[0]->contentType);
        $this->assertSame(1024, $email->attachments[0]->size);
    }
}
