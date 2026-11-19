<?php

namespace Tests\Services;

use EInvoiceAPI\Conversion\DocumentCreateFromPdfTask;
use EInvoiceAPI\Core\Exceptions\NotFoundException;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
final class ConversionTest extends ServiceTestCase
{
    #[Test]
    public function testCreateFromPdf(): void
    {
        // `POST /api/conversion/pdf` answers 201.
        $this->http->queueJson(['task_id' => 'task_id'], 201);

        $result = $this->client->conversion->createFromPdf(
            file: 'file',
            requestOptions: $this->options(),
        );

        $this->assertUploadRequest('/api/conversion/pdf');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentCreateFromPdfTask::class, $result);
        $this->assertSame('task_id', $result->taskID);
        $this->assertNull($result->status);
    }

    #[Test]
    public function testCreateFromPdfWithOptionalParams(): void
    {
        $this->http->queueJson(['task_id' => 'task_id', 'status' => 'pending'], 201);

        $result = $this->client->conversion->createFromPdf(
            file: 'file',
            requestOptions: $this->options(),
        );

        $this->assertUploadRequest('/api/conversion/pdf');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentCreateFromPdfTask::class, $result);
        $this->assertSame('task_id', $result->taskID);
        $this->assertSame('pending', $result->status);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson(['task_id' => 'task_id', 'status' => 'completed']);

        $result = $this->client->conversion->retrieve('task_id', requestOptions: $this->options());

        $this->assertRequest('GET', '/api/conversion/pdf/task_id');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentCreateFromPdfTask::class, $result);
        $this->assertSame('task_id', $result->taskID);
        $this->assertSame('completed', $result->status);
    }

    #[Test]
    public function testRetrieveResult(): void
    {
        $this->http->queueJson([
            'success' => true,
            'document_type' => 'INVOICE',
            'direction' => 'OUTBOUND',
            'state' => 'DRAFT',
            'invoice_id' => 'INV-2024-001',
            'invoice_date' => '2024-01-15',
            'due_date' => '2024-02-14',
            'currency' => 'EUR',
            'invoice_total' => '121.00',
            'customer_name' => 'Acme',
        ]);

        $result = $this->client->conversion->retrieveResult(
            'task_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/conversion/pdf/task_id/result');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DocumentNewFromPdfResponse::class, $result);
        $this->assertTrue($result->success);
        $this->assertSame('INVOICE', $result->documentType);
        $this->assertSame('INV-2024-001', $result->invoiceID);
        $this->assertSame('2024-01-15', $result->invoiceDate?->format('Y-m-d'));
        $this->assertSame('121.00', $result->invoiceTotal);
        $this->assertSame('Acme', $result->customerName);
        $this->assertNull($result->errorMessage);
    }

    #[Test]
    public function testRetrieveOfAnExpiredTaskThrowsNotFound(): void
    {
        // The 404 of `GET /api/conversion/pdf/{task_id}` is an `ErrorResponse`.
        $this->http->queueJson(['detail' => 'Task not found or expired'], 404);

        try {
            $this->client->conversion->retrieve('task_id', requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (NotFoundException $e) {
            $this->assertSame(404, $e->status);
            $this->assertSame(['detail' => 'Task not found or expired'], $e->body);
        }

        $this->assertRequest('GET', '/api/conversion/pdf/task_id');
    }

    #[Test]
    public function testRetrieveResultOfAnExpiredTaskThrowsNotFound(): void
    {
        // The 404 of `GET /api/conversion/pdf/{task_id}/result` is an `ErrorResponse`.
        $this->http->queueJson(['detail' => 'PDF conversion result not found or expired'], 404);

        try {
            $this->client->conversion->retrieveResult('task_id', requestOptions: $this->options());
            $this->fail('The client did not throw.');
        } catch (NotFoundException $e) {
            $this->assertSame(404, $e->status);
            $this->assertSame(['detail' => 'PDF conversion result not found or expired'], $e->body);
        }

        $this->assertRequest('GET', '/api/conversion/pdf/task_id/result');
    }
}
