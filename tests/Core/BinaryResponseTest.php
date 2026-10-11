<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
#[CoversNothing]
class BinaryResponseTest extends TestCase
{
    #[Test]
    #[DataProvider('attachments')]
    public function testAttachmentIsReturnedByteIdentical(string $contentType, string $body): void
    {
        $transporter = new class($contentType, $body) implements ClientInterface {
            public function __construct(private string $contentType, private string $body) {}

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                return new Response(200, ['Content-Type' => $this->contentType], $this->body);
            }
        };
        $client = new Client(apiKey: 'My API Key', baseUrl: 'http://localhost');
        $options = RequestOptions::with(transporter: $transporter);

        $result = $client->mailbox->downloadAttachment('file', inboundEmailID: 'mail_1', requestOptions: $options);
        $raw = $client->mailbox->raw->downloadAttachment('file', params: ['inboundEmailID' => 'mail_1'], requestOptions: $options);

        $this->assertSame($body, $result);
        $this->assertSame($body, $raw->parse());
    }

    /**
     * @return iterable<string,array{string,string}>
     */
    public static function attachments(): iterable
    {
        yield 'json' => ['application/json', '{"a":1}'];

        yield 'pdf' => ['application/pdf', "%PDF-1.4\n\x00\xFF\xFE bytes"];

        yield 'text' => ['text/plain; charset=utf-8', "line 1\r\nline 2\n"];
    }
}
