<?php

namespace Tests\Services;

use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse\Event;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentResponse\Item;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Validate\UblDocumentValidation;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\RequestInterface;

/**
 * @internal
 */
#[CoversNothing]
final class DocumentsTest extends ServiceTestCase
{
    #[Test]
    public function testCreate(): void
    {
        $this->http->queueJson([
            'id' => 'doc_123',
            'created_at' => '2024-01-15T10:30:00Z',
            'state' => 'DRAFT',
        ]);

        $result = $this->client->documents->create(
            requestOptions: $this->options()
        );

        $this->assertRequest('POST', '/api/documents/', body: ['tax_code' => 'S']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
        $this->assertSame('doc_123', $result->id);
        $this->assertSame('DRAFT', $result->state);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $this->http->queueJson([
            'id' => 'doc_123',
            'created_at' => '2024-01-15T10:30:00Z',
            'customer_peppol_id' => '0208:0123456789',
            'document_type' => 'SELFBILLING_INVOICE',
            'items' => [
                [
                    'description' => 'description',
                    'item_attributes' => [['name' => 'name', 'value' => 'value']],
                ],
            ],
        ]);

        $result = $this->client->documents->create(
            constructPdf: true,
            customerPeppolID: '0208:0123456789',
            documentType: DocumentType::SELFBILLING_INVOICE,
            items: [
                [
                    'description' => 'description',
                    'itemAttributes' => [['name' => 'name', 'value' => 'value']],
                ],
            ],
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'POST',
            '/api/documents/',
            query: ['construct_pdf' => 'true'],
            body: [
                'customer_peppol_id' => '0208:0123456789',
                'document_type' => 'SELFBILLING_INVOICE',
                'items' => [
                    [
                        'description' => 'description',
                        'item_attributes' => [['name' => 'name', 'value' => 'value']],
                    ],
                ],
                'tax_code' => 'S',
            ],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
        $this->assertSame('0208:0123456789', $result->customerPeppolID);
        $this->assertSame('SELFBILLING_INVOICE', $result->documentType);
        $this->assertCount(1, $result->items ?? []);
        $this->assertContainsOnlyInstancesOf(Item::class, $result->items ?? []);
        $this->assertSame('description', $result->items[0]->description ?? null);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson([
            'id' => 'document_id',
            'created_at' => '2024-01-15T10:30:00Z',
            'invoice_id' => 'INV-2024-001',
        ]);

        $result = $this->client->documents->retrieve(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('GET', '/api/documents/document_id');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
        $this->assertSame('document_id', $result->id);
        $this->assertSame('INV-2024-001', $result->invoiceID);
        $this->assertNotNull($result['createdAt']);
        $this->assertSame(
            '2024-01-15T10:30:00+00:00',
            $result->createdAt->format(DATE_ATOM)
        );
    }

    #[Test]
    public function testDelete(): void
    {
        $this->http->queueJson(['is_deleted' => true]);

        $result = $this->client->documents->delete(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('DELETE', '/api/documents/document_id');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentDeleteResponse::class, $result);
        $this->assertTrue($result->isDeleted);
    }

    #[Test]
    public function testCreateFromPdf(): void
    {
        $this->http->queueJson([
            'invoice_id' => 'INV-2024-001',
            'success' => true,
        ]);

        $result = $this->client->documents->createFromPdf(
            file: 'file',
            requestOptions: $this->options()
        );

        $this->assertMultipartRequest('/api/documents/pdf', []);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentNewFromPdfResponse::class, $result);
        $this->assertSame('INV-2024-001', $result->invoiceID);
    }

    #[Test]
    public function testCreateFromPdfWithOptionalParams(): void
    {
        $this->http->queueJson([
            'customer_tax_id' => 'customer_tax_id',
            'vendor_tax_id' => 'vendor_tax_id',
        ]);

        $result = $this->client->documents->createFromPdf(
            file: 'file',
            customerTaxID: 'customer_tax_id',
            vendorTaxID: 'vendor_tax_id',
            requestOptions: $this->options(),
        );

        $request = $this->assertMultipartRequest('/api/documents/pdf', [
            'customer_tax_id' => 'customer_tax_id',
            'vendor_tax_id' => 'vendor_tax_id',
        ]);
        // The tax IDs are query parameters; they must not be in the form body.
        $this->assertStringNotContainsString('tax_id', (string) $request->getBody());
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentNewFromPdfResponse::class, $result);
        $this->assertSame('customer_tax_id', $result->customerTaxID);
        $this->assertSame('vendor_tax_id', $result->vendorTaxID);
    }

    #[Test]
    public function testRetrieveTimeline(): void
    {
        $this->http->queueJson([
            'document_id' => 'document_id',
            'events' => [
                [
                    'event_type' => 'document_created',
                    'timestamp' => '2024-01-15T10:30:00Z',
                    'id' => 'evt_1',
                ],
                [
                    'event_type' => 'send_success',
                    'timestamp' => '2024-01-15T10:31:00Z',
                    'details' => ['transmission_id' => 'abc'],
                ],
            ],
        ]);

        $result = $this->client->documents->retrieveTimeline(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('GET', '/api/documents/document_id/timeline');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentGetTimelineResponse::class, $result);
        $this->assertSame('document_id', $result->documentID);
        $this->assertCount(2, $result->events);
        $this->assertContainsOnlyInstancesOf(Event::class, $result->events);
        $this->assertSame('document_created', $result->events[0]->eventType);
        $this->assertSame('evt_1', $result->events[0]->id);
        $this->assertSame('send_success', $result->events[1]->eventType);
        $this->assertSame(['transmission_id' => 'abc'], $result->events[1]->details);
    }

    #[Test]
    public function testSend(): void
    {
        $this->http->queueJson([
            'id' => 'document_id',
            'created_at' => '2024-01-15T10:30:00Z',
            'state' => 'TRANSIT',
        ]);

        $result = $this->client->documents->send(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('POST', '/api/documents/document_id/send');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
        $this->assertSame('document_id', $result->id);
        $this->assertSame('TRANSIT', $result->state);
    }

    #[Test]
    public function testValidate(): void
    {
        $this->http->queueJson([
            'id' => 'document_id',
            'file_name' => 'invoice.xml',
            'is_valid' => false,
            'issues' => [
                [
                    'message' => 'Buyer reference is missing',
                    'schematron' => 'PEPPOL-EN16931-UBL',
                    'type' => 'error',
                    'rule_id' => 'PEPPOL-EN16931-R003',
                ],
            ],
        ]);

        $result = $this->client->documents->validate(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('POST', '/api/documents/document_id/validate');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
        $this->assertSame('document_id', $result->id);
        $this->assertSame('invoice.xml', $result->fileName);
        $this->assertFalse($result->isValid);
        $this->assertCount(1, $result->issues);
        $this->assertSame('error', $result->issues[0]->type);
        $this->assertSame('PEPPOL-EN16931-R003', $result->issues[0]->ruleID);
    }

    /**
     * Asserts on a multipart upload request that has a `file` part with the content `file`.
     *
     * @param array<string,string> $query
     */
    private function assertMultipartRequest(
        string $path,
        array $query
    ): RequestInterface {
        $this->assertCount(1, $this->http->requests);
        $request = $this->http->requests[0];

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($path, $request->getUri()->getPath());
        $this->assertSame('Bearer My API Key', $request->getHeaderLine('Authorization'));

        parse_str($request->getUri()->getQuery(), $sentQuery);
        $this->assertEquals($query, $sentQuery);

        $this->assertStringStartsWith(
            'multipart/form-data',
            $request->getHeaderLine('Content-Type')
        );
        $body = (string) $request->getBody();
        $this->assertStringContainsString('name="file"; filename="upload"', $body);
        $this->assertStringContainsString("\r\n\r\nfile\r\n", $body);

        return $request;
    }
}
