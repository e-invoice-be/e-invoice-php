<?php

namespace Tests\Services\Documents;

use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Tests\Services\ServiceTestCase;

/**
 * @internal
 */
#[CoversNothing]
final class UblTest extends ServiceTestCase
{
    #[Test]
    public function testCreateFromUbl(): void
    {
        $this->http->queueJson([
            'id' => 'doc_123',
            'created_at' => '2024-01-15T10:30:00Z',
        ], 201);

        $result = $this->client->documents->ubl->createFromUbl(
            file: 'file',
            requestOptions: $this->options()
        );

        $this->assertFileUpload();
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
        $this->assertSame('doc_123', $result->id);
    }

    #[Test]
    public function testCreateFromUblWithOptionalParams(): void
    {
        $this->http->queueJson([
            'id' => 'doc_123',
            'created_at' => '2024-01-15T10:30:00Z',
            'state' => 'DRAFT',
            'invoice_id' => 'INV-2024-001',
        ], 201);

        $result = $this->client->documents->ubl->createFromUbl(
            file: 'file',
            requestOptions: $this->options()
        );

        $this->assertFileUpload();
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
        $this->assertSame('DRAFT', $result->state);
        $this->assertSame('INV-2024-001', $result->invoiceID);
    }

    #[Test]
    public function testGet(): void
    {
        $this->http->queueJson([
            'id' => 'document_id',
            'file_name' => 'invoice.xml',
            'file_hash' => 'abc123',
            'file_size' => 4096,
            'receiver_peppol_id' => '0123456789',
            'receiver_peppol_scheme' => '0208',
            'signed_url' => 'https://example.com/invoice.xml',
            'validated_at' => '2024-01-15T10:30:00Z',
        ]);

        $result = $this->client->documents->ubl->get(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('GET', '/api/documents/document_id/ubl');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblGetResponse::class, $result);
        $this->assertSame('document_id', $result->id);
        $this->assertSame('invoice.xml', $result->fileName);
        $this->assertSame(4096, $result->fileSize);
        $this->assertSame('0123456789', $result->receiverPeppolID);
        $this->assertSame('https://example.com/invoice.xml', $result->signedURL);
        $this->assertSame(
            '2024-01-15T10:30:00+00:00',
            $result->validatedAt?->format(DATE_ATOM)
        );
    }

    /**
     * Asserts on the multipart upload request that has a `file` part with the content `file`.
     */
    private function assertFileUpload(): void
    {
        $this->assertCount(1, $this->http->requests);
        $request = $this->http->requests[0];

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/api/documents/ubl', $request->getUri()->getPath());
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
