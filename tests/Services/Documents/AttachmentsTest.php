<?php

namespace Tests\Services\Documents;

use EInvoiceAPI\Documents\Attachments\AttachmentDeleteResponse;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Tests\Services\ServiceTestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AttachmentsTest extends ServiceTestCase
{
    private const ATTACHMENT = [
        'id' => 'attachment_id',
        'file_name' => 'timesheet.pdf',
        'file_size' => 2048,
        'file_type' => 'application/pdf',
        'file_url' => 'https://example.com/timesheet.pdf',
    ];

    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson(self::ATTACHMENT);

        $result = $this->client->documents->attachments->retrieve(
            'attachment_id',
            documentID: 'document_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'GET',
            '/api/documents/document_id/attachments/attachment_id'
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentAttachment::class, $result);
        $this->assertSame('attachment_id', $result->id);
        $this->assertSame('timesheet.pdf', $result->fileName);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $this->http->queueJson(self::ATTACHMENT);

        $result = $this->client->documents->attachments->retrieve(
            'attachment_id',
            documentID: 'document_id',
            requestOptions: $this->options(),
        );

        // The document ID is a path parameter; it must not be in the query or the body.
        $this->assertRequest(
            'GET',
            '/api/documents/document_id/attachments/attachment_id'
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentAttachment::class, $result);
        $this->assertSame(2048, $result->fileSize);
        $this->assertSame('application/pdf', $result->fileType);
        $this->assertSame('https://example.com/timesheet.pdf', $result->fileURL);
    }

    #[Test]
    public function testList(): void
    {
        $this->http->queueJson([
            self::ATTACHMENT,
            ['id' => 'attachment_2', 'file_name' => 'contract.pdf'],
        ]);

        $result = $this->client->documents->attachments->list(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('GET', '/api/documents/document_id/attachments');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(DocumentAttachment::class, $result);
        $this->assertSame('attachment_id', $result[0]->id);
        $this->assertSame('contract.pdf', $result[1]->fileName);
        $this->assertNull($result[1]->fileSize);
    }

    #[Test]
    public function testDelete(): void
    {
        $this->http->queueJson(['is_deleted' => true]);

        $result = $this->client->documents->attachments->delete(
            'attachment_id',
            documentID: 'document_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'DELETE',
            '/api/documents/document_id/attachments/attachment_id'
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AttachmentDeleteResponse::class, $result);
        $this->assertTrue($result->isDeleted);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $this->http->queueJson(['is_deleted' => false]);

        $result = $this->client->documents->attachments->delete(
            'attachment_id',
            documentID: 'document_id',
            requestOptions: $this->options(),
        );

        // The document ID is a path parameter; it must not be in the query or the body.
        $this->assertRequest(
            'DELETE',
            '/api/documents/document_id/attachments/attachment_id'
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AttachmentDeleteResponse::class, $result);
        $this->assertFalse($result->isDeleted);
    }

    #[Test]
    public function testAdd(): void
    {
        $this->http->queueJson(self::ATTACHMENT, 201);

        $result = $this->client->documents->attachments->add(
            'document_id',
            file: 'file',
            requestOptions: $this->options(),
        );

        $this->assertFileUpload();
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentAttachment::class, $result);
        $this->assertSame('attachment_id', $result->id);
        $this->assertSame('timesheet.pdf', $result->fileName);
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        $this->http->queueJson(self::ATTACHMENT, 201);

        $result = $this->client->documents->attachments->add(
            'document_id',
            file: 'file',
            requestOptions: $this->options(),
        );

        $this->assertFileUpload();
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentAttachment::class, $result);
        $this->assertSame(2048, $result->fileSize);
        $this->assertSame('application/pdf', $result->fileType);
    }

    /**
     * Asserts on the multipart upload request that has a `file` part with the content `file`.
     */
    private function assertFileUpload(): void
    {
        $this->assertCount(1, $this->http->requests);
        $request = $this->http->requests[0];

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(
            '/api/documents/document_id/attachments',
            $request->getUri()->getPath()
        );
        $this->assertSame('', $request->getUri()->getQuery());
        $this->assertSame('Bearer My API Key', $request->getHeaderLine('Authorization'));
        $this->assertStringStartsWith(
            'multipart/form-data',
            $request->getHeaderLine('Content-Type')
        );

        $body = (string) $request->getBody();
        $this->assertStringContainsString('name="file"; filename="upload"', $body);
        $this->assertStringContainsString("\r\n\r\nfile\r\n", $body);
    }
}
