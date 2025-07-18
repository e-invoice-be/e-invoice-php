<?php

namespace Tests\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Parameters\Documents\AttachmentAddParam;
use EInvoiceAPI\Parameters\Documents\AttachmentDeleteParam;
use EInvoiceAPI\Parameters\Documents\AttachmentRetrieveParam;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class AttachmentsTest extends TestCase
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->documents
            ->attachments
            ->retrieve(
                'attachment_id',
                new AttachmentRetrieveParam(documentID: 'document_id')
            )
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->documents
            ->attachments
            ->retrieve(
                'attachment_id',
                new AttachmentRetrieveParam(documentID: 'document_id')
            )
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this->client->documents->attachments->list('document_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->documents
            ->attachments
            ->delete(
                'attachment_id',
                new AttachmentDeleteParam(documentID: 'document_id')
            )
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->documents
            ->attachments
            ->delete(
                'attachment_id',
                new AttachmentDeleteParam(documentID: 'document_id')
            )
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAdd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->documents
            ->attachments
            ->add('document_id', new AttachmentAddParam(file: 'file'))
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: tests are disabled for the time being');
        }

        $result = $this
            ->client
            ->documents
            ->attachments
            ->add('document_id', new AttachmentAddParam(file: 'file'))
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
