<?php

namespace Tests\Services;

use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentCreateParams\TaxCode;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event as LifecycleEvent;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\CanonicalStatus;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Direction;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Level;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Source;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse\Event;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentResponse\Item;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Validate\UblDocumentValidation;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
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

        // The service sends the defaults of the API specification.
        $this->assertRequest('POST', '/api/documents/', body: [
            'currency' => 'EUR',
            'direction' => 'OUTBOUND',
            'document_type' => 'INVOICE',
            'state' => 'DRAFT',
            'tax_code' => 'S',
        ]);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentResponse::class, $result);
        $this->assertSame('doc_123', $result->id);
        $this->assertSame('DRAFT', $result->state);
    }

    #[Test]
    public function testCreateOverridesTheSpecDefaults(): void
    {
        $this->http->queueJson(['id' => 'doc_123', 'created_at' => '2024-01-15T10:30:00Z']);

        $this->client->documents->create(
            currency: CurrencyCode::USD,
            direction: 'INBOUND',
            documentType: DocumentType::CREDIT_NOTE,
            state: DocumentState::SENT,
            taxCode: TaxCode::Z,
            requestOptions: $this->options(),
        );

        $this->assertRequest('POST', '/api/documents/', body: [
            'currency' => 'USD',
            'direction' => 'INBOUND',
            'document_type' => 'CREDIT_NOTE',
            'state' => 'SENT',
            'tax_code' => 'Z',
        ]);
    }

    #[Test]
    public function testCreateOmitsADefaultedFieldPassedAsNull(): void
    {
        $this->http->queueJson(['id' => 'doc_123', 'created_at' => '2024-01-15T10:30:00Z']);

        $this->client->documents->create(
            currency: null,
            direction: null,
            documentType: null,
            state: null,
            requestOptions: $this->options(),
        );

        // The server then applies its own default.
        $this->assertRequest('POST', '/api/documents/', body: ['tax_code' => 'S']);
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
                'currency' => 'EUR',
                'customer_peppol_id' => '0208:0123456789',
                'direction' => 'OUTBOUND',
                'document_type' => 'SELFBILLING_INVOICE',
                'items' => [
                    [
                        'description' => 'description',
                        'item_attributes' => [['name' => 'name', 'value' => 'value']],
                    ],
                ],
                'state' => 'DRAFT',
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
    public function testCreateWithBusinessReferences(): void
    {
        $this->http->queueJson([
            'id' => 'doc_123',
            'created_at' => '2024-01-15T10:30:00Z',
        ]);

        $this->client->documents->create(
            buyerReference: 'CC-42',
            customerPhone: '+32 2 123 45 67',
            items: [
                [
                    'date' => new \DateTimeImmutable('2024-01-31T00:00:00Z'),
                    'name' => 'Wireless mouse',
                    'priceBaseQuantity' => 100,
                    'unitPrice' => '250.00',
                ],
            ],
            precedingInvoiceDate: '2024-01-15',
            precedingInvoiceID: 'INV-2024-001',
            roundingAmount: '-0.40',
            salesOrder: 'SO-7',
            taxCurrency: 'SEK',
            totalTaxInTaxCurrency: 1150.5,
            vendorPhone: '+49 30 1234567',
            requestOptions: $this->options(),
        );

        $this->assertRequest('POST', '/api/documents/', body: [
            'buyer_reference' => 'CC-42',
            'currency' => 'EUR',
            'customer_phone' => '+32 2 123 45 67',
            'direction' => 'OUTBOUND',
            'document_type' => 'INVOICE',
            'items' => [
                [
                    'date' => '2024-01-31T00:00:00+00:00',
                    'name' => 'Wireless mouse',
                    'price_base_quantity' => 100,
                    'unit_price' => '250.00',
                ],
            ],
            'preceding_invoice_date' => '2024-01-15',
            'preceding_invoice_id' => 'INV-2024-001',
            'rounding_amount' => '-0.40',
            'sales_order' => 'SO-7',
            'state' => 'DRAFT',
            'tax_code' => 'S',
            'tax_currency' => 'SEK',
            'total_tax_in_tax_currency' => 1150.5,
            'vendor_phone' => '+49 30 1234567',
        ]);
    }

    #[Test]
    public function testRetrieveWithBusinessReferences(): void
    {
        $this->http->queueJson([
            'id' => 'document_id',
            'created_at' => '2024-01-15T10:30:00Z',
            'buyer_reference' => 'CC-42',
            'customer_phone' => '+32 2 123 45 67',
            'items' => [
                [
                    'date' => '2024-01-31',
                    'description' => 'Ergonomic, 2.4 GHz',
                    'name' => 'Wireless mouse',
                    'price_base_quantity' => '100',
                ],
            ],
            'preceding_invoice_date' => '2024-01-15',
            'preceding_invoice_id' => 'INV-2024-001',
            'rounding_amount' => '-0.40',
            'sales_order' => 'SO-7',
            'tax_currency' => 'SEK',
            'total_tax_in_tax_currency' => '1150.50',
            'vendor_phone' => '+49 30 1234567',
        ]);

        $result = $this->client->documents->retrieve(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertSame('CC-42', $result->buyerReference);
        $this->assertSame('+32 2 123 45 67', $result->customerPhone);
        $this->assertSame('2024-01-15', $result->precedingInvoiceDate?->format('Y-m-d'));
        $this->assertSame('INV-2024-001', $result->precedingInvoiceID);
        $this->assertSame('-0.40', $result->roundingAmount);
        $this->assertSame('SO-7', $result->salesOrder);
        $this->assertSame('SEK', $result->taxCurrency);
        $this->assertSame('1150.50', $result->totalTaxInTaxCurrency);
        $this->assertSame('+49 30 1234567', $result->vendorPhone);

        $item = ($result->items ?? [])[0];
        $this->assertSame('2024-01-31', $item->date?->format('Y-m-d'));
        $this->assertSame('Wireless mouse', $item->name);
        $this->assertSame('Ergonomic, 2.4 GHz', $item->description);
        $this->assertSame('100', $item->priceBaseQuantity);
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

        $this->assertUploadRequest('/api/documents/pdf');
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

        $request = $this->assertUploadRequest('/api/documents/pdf', [
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
    public function testCreateFromPdfWithBusinessReferences(): void
    {
        $this->http->queueJson([
            'buyer_reference' => 'CC-42',
            'customer_phone' => '+32 2 123 45 67',
            'items' => [['date' => '2024-01-31', 'name' => 'Wireless mouse', 'price_base_quantity' => '1']],
            'note' => 'Thank you',
            'payment_details' => [['iban' => 'BE71096123456769']],
            'preceding_invoice_date' => '2024-01-15',
            'preceding_invoice_id' => 'INV-2024-001',
            'rounding_amount' => '0.10',
            'sales_order' => 'SO-7',
            'subtotal' => '100.00',
            'success' => true,
            'tax_currency' => 'SEK',
            'total_tax_in_tax_currency' => '1150.50',
            'vendor_phone' => '+49 30 1234567',
        ]);

        $result = $this->client->documents->createFromPdf(
            file: 'file',
            requestOptions: $this->options()
        );

        $this->assertSame('CC-42', $result->buyerReference);
        $this->assertSame('+32 2 123 45 67', $result->customerPhone);
        $this->assertSame('Wireless mouse', ($result->items ?? [])[0]->name);
        $this->assertSame('2024-01-31', ($result->items ?? [])[0]->date?->format('Y-m-d'));
        $this->assertSame('Thank you', $result->note);
        $this->assertSame('BE71096123456769', ($result->paymentDetails ?? [])[0]->iban);
        $this->assertSame('2024-01-15', $result->precedingInvoiceDate?->format('Y-m-d'));
        $this->assertSame('INV-2024-001', $result->precedingInvoiceID);
        $this->assertSame('0.10', $result->roundingAmount);
        $this->assertSame('SO-7', $result->salesOrder);
        $this->assertSame('100.00', $result->subtotal);
        $this->assertTrue($result->success);
        $this->assertSame('SEK', $result->taxCurrency);
        $this->assertSame('1150.50', $result->totalTaxInTaxCurrency);
        $this->assertSame('+49 30 1234567', $result->vendorPhone);
    }

    #[Test]
    public function testRetrieveLifecycle(): void
    {
        $this->http->queueJson([
            'document_id' => 'document_id',
            'events' => [
                [
                    'level' => 'transport',
                    'canonical_status' => 'delivered',
                    'native_code' => 'AP',
                    'source' => 'peppol:mlr',
                    'direction' => 'in',
                    'reason_code' => null,
                    'reason' => null,
                    'occurred_at' => '2024-01-15T10:31:00Z',
                ],
                [
                    'level' => 'business',
                    'canonical_status' => null,
                    'native_code' => 'XX',
                    'source' => 'fr:superpdp',
                    'direction' => 'in',
                    'reason_code' => 'REF',
                    'reason' => 'Unknown reference',
                    'occurred_at' => '2024-01-16T09:00:00Z',
                ],
            ],
        ]);

        $result = $this->client->documents->retrieveLifecycle(
            'document_id',
            requestOptions: $this->options()
        );

        $this->assertRequest('GET', '/api/documents/document_id/lifecycle');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentGetLifecycleResponse::class, $result);
        $this->assertSame('document_id', $result->documentID);
        $this->assertCount(2, $result->events);
        $this->assertContainsOnlyInstancesOf(LifecycleEvent::class, $result->events);

        [$delivered, $unmapped] = $result->events;
        $this->assertSame(Level::TRANSPORT->value, $delivered->level);
        $this->assertSame(CanonicalStatus::DELIVERED->value, $delivered->canonicalStatus);
        $this->assertSame('AP', $delivered->nativeCode);
        $this->assertSame(Source::PEPPOL_MLR->value, $delivered->source);
        $this->assertSame(Direction::IN->value, $delivered->direction);
        $this->assertNull($delivered->reasonCode);
        $this->assertNull($delivered->reason);
        $this->assertSame('2024-01-15T10:31:00+00:00', $delivered->occurredAt->format(DATE_ATOM));

        $this->assertSame('business', $unmapped->level);
        $this->assertNull($unmapped->canonicalStatus);
        $this->assertSame('XX', $unmapped->nativeCode);
        $this->assertSame('fr:superpdp', $unmapped->source);
        $this->assertSame('REF', $unmapped->reasonCode);
        $this->assertSame('Unknown reference', $unmapped->reason);
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
}
