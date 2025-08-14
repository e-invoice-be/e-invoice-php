<?php

namespace Tests\Resources\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Documents\Attachments\AttachmentAddParams;
use EInvoiceAPI\Documents\Attachments\AttachmentDeleteParams;
use EInvoiceAPI\Documents\Attachments\AttachmentRetrieveParams;
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
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AttachmentRetrieveParams::with(documentID: 'document_id');
        $result = $this
            ->client
            ->documents
            ->attachments
            ->retrieve('attachment_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AttachmentRetrieveParams::with(documentID: 'document_id');
        $result = $this
            ->client
            ->documents
            ->attachments
            ->retrieve('attachment_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->documents->attachments->list('document_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AttachmentDeleteParams::with(documentID: 'document_id');
        $result = $this
            ->client
            ->documents
            ->attachments
            ->delete('attachment_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AttachmentDeleteParams::with(documentID: 'document_id');
        $result = $this
            ->client
            ->documents
            ->attachments
            ->delete('attachment_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAdd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AttachmentAddParams::with(file: 'file');
        $result = $this
            ->client
            ->documents
            ->attachments
            ->add('document_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AttachmentAddParams::with(file: 'file');
        $result = $this
            ->client
            ->documents
            ->attachments
            ->add('document_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
