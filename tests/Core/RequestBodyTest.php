<?php

namespace Tests\Core;

use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Core\Util;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * How `Util::withSetBody()` encodes a request body for its Content-Type.
 *
 * @internal
 */
final class RequestBodyTest extends TestCase
{
    private Psr17Factory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new Psr17Factory;
    }

    #[Test]
    public function testJsonBodyKeepsSlashesAndUnicode(): void
    {
        $request = $this->withBody('application/json', ['url' => 'https://example.com/a', 'name' => 'Café']);

        $this->assertSame('{"url":"https://example.com/a","name":"Café"}', (string) $request->getBody());
    }

    #[Test]
    public function testEmptyObjectIsSentAsAnEmptyJsonObject(): void
    {
        $request = $this->withBody('application/json', new \stdClass);

        $this->assertSame('{}', (string) $request->getBody());
    }

    #[Test]
    public function testStreamBodyIsSentAsIs(): void
    {
        $stream = $this->factory->createStream('<Invoice/>');

        $request = $this->withBody('application/json', $stream);

        $this->assertSame($stream, $request->getBody());
    }

    #[Test]
    public function testResourceBodyIsStreamed(): void
    {
        $resource = fopen('php://memory', 'r+');
        $this->assertIsResource($resource);
        fwrite($resource, '<Invoice/>');
        rewind($resource);

        $request = $this->withBody('application/xml', $resource);

        $this->assertSame('<Invoice/>', (string) $request->getBody());
    }

    #[Test]
    public function testScalarBodyWithoutAKnownContentTypeIsNotSent(): void
    {
        $request = $this->withBody('text/plain', 'ignored');

        $this->assertSame('', (string) $request->getBody());
    }

    #[Test]
    public function testMultipartPartsHaveTheContentTypeOfTheirValue(): void
    {
        $file = fopen('php://memory', 'r+');
        $this->assertIsResource($file);
        fwrite($file, '%PDF-1.7');
        rewind($file);

        $request = $this->withBody('multipart/form-data', [
            'file' => FileParam::fromResource($file, filename: 'in"voice.pdf', contentType: 'application/pdf'),
            'note' => 'hello',
            'count' => 3,
            'flag' => true,
            'meta' => ['a' => 1],
            'raw' => FileParam::fromString('x', filename: "a\r\nb"),
        ]);

        $contentType = $request->getHeaderLine('Content-Type');
        $this->assertMatchesRegularExpression('/^multipart\/form-data; boundary=[A-Za-z0-9_-]+$/', $contentType);
        $boundary = substr($contentType, strlen('multipart/form-data; boundary='));

        $this->assertSame(
            "--{$boundary}\r\n"
            ."Content-Disposition: form-data; name=\"file\"; filename=\"in%22voice.pdf\"\r\nContent-Type: application/pdf\r\n\r\n%PDF-1.7\r\n"
            ."--{$boundary}\r\n"
            ."Content-Disposition: form-data; name=\"note\"\r\nContent-Type: text/plain\r\n\r\nhello\r\n"
            ."--{$boundary}\r\n"
            ."Content-Disposition: form-data; name=\"count\"\r\nContent-Type: text/plain\r\n\r\n3\r\n"
            ."--{$boundary}\r\n"
            ."Content-Disposition: form-data; name=\"flag\"\r\nContent-Type: text/plain\r\n\r\n1\r\n"
            ."--{$boundary}\r\n"
            ."Content-Disposition: form-data; name=\"meta\"\r\nContent-Type: application/json\r\n\r\n{\"a\":1}\r\n"
            ."--{$boundary}\r\n"
            ."Content-Disposition: form-data; name=\"raw\"; filename=\"a%0D%0Ab\"\r\nContent-Type: application/octet-stream\r\n\r\nx\r\n"
            ."--{$boundary}--\r\n",
            (string) $request->getBody(),
        );
    }

    #[Test]
    public function testMultipartBodyThatIsNotAMapIsOnePartWithoutName(): void
    {
        $request = $this->withBody('multipart/form-data', 'only');

        $this->assertStringContainsString("Content-Disposition: form-data\r\nContent-Type: text/plain\r\n\r\nonly\r\n", (string) $request->getBody());
    }

    #[Test]
    public function testEachMultipartBodyHasANewBoundary(): void
    {
        $first = $this->withBody('multipart/form-data', ['a' => 'b'])->getHeaderLine('Content-Type');
        $second = $this->withBody('multipart/form-data', ['a' => 'b'])->getHeaderLine('Content-Type');

        $this->assertNotSame($first, $second);
    }

    #[Test]
    public function testFileParamRejectsAString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a resource, got string');

        // @phpstan-ignore argument.type
        FileParam::fromResource('/tmp/invoice.pdf');
    }

    private function withBody(string $contentType, mixed $body): RequestInterface
    {
        $request = $this->factory->createRequest('POST', 'http://localhost/upload')->withHeader('Content-Type', $contentType);

        // @phpstan-ignore argument.type
        return Util::withSetBody($this->factory, $request, $body);
    }
}
