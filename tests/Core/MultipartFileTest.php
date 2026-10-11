<?php

namespace Tests\Core;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Documents\Attachments\AttachmentAddParams;
use EInvoiceAPI\RequestOptions;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversNothing]
class MultipartFileTest extends TestCase
{
    /** @var list<RequestInterface> */
    private array $requests = [];

    #[Test]
    public function testStringFileIsSentAsAFilePart(): void
    {
        $this->client()->documents->attachments->add('doc_1', file: '%PDF-1.4 bytes', requestOptions: $this->options());

        $this->assertSame(
            [
                [
                    'disposition' => 'form-data; name="file"; filename="upload"',
                    'type' => 'application/octet-stream',
                    'content' => '%PDF-1.4 bytes',
                ],
            ],
            $this->parts(),
        );
    }

    #[Test]
    public function testFileParamSetsFilenameAndContentType(): void
    {
        $file = FileParam::fromString('<Invoice/>', filename: 'invoice "1".xml', contentType: 'application/xml');
        $this->client()->validate->validateUbl(file: $file, requestOptions: $this->options());

        $this->assertSame('/api/validate/ubl', $this->requests[0]->getUri()->getPath());
        $this->assertSame(
            [['disposition' => 'form-data; name="file"; filename="invoice %221%22.xml"', 'type' => 'application/xml', 'content' => '<Invoice/>']],
            $this->parts(),
        );
    }

    #[Test]
    public function testResourceFileIsNamedAfterItsPath(): void
    {
        $path = sys_get_temp_dir().'/'.uniqid('multipart').'.pdf';
        file_put_contents($path, str_repeat('%PDF', 5000));
        $resource = fopen($path, 'r');
        $this->assertIsResource($resource);

        try {
            $this->client()->conversion->createFromPdf(
                file: FileParam::fromResource($resource, contentType: 'application/pdf'),
                requestOptions: $this->options(),
            );
        } finally {
            // The upload must leave the resource open, `fclose` would throw otherwise.
            fclose($resource);
            unlink($path);
        }

        $this->assertSame(
            [['disposition' => 'form-data; name="file"; filename="'.basename($path).'"', 'type' => 'application/pdf', 'content' => str_repeat('%PDF', 5000)]],
            $this->parts(),
        );
    }

    #[Test]
    public function testResourceWithoutAPathGetsTheDefaultFilename(): void
    {
        $resource = fopen('php://memory', 'r+');
        $this->assertIsResource($resource);
        fwrite($resource, '<Invoice/>');
        rewind($resource);

        $this->client()->documents->ubl->createFromUbl(file: FileParam::fromResource($resource), requestOptions: $this->options());
        fclose($resource);

        $this->assertSame(
            [['disposition' => 'form-data; name="file"; filename="upload"', 'type' => 'application/octet-stream', 'content' => '<Invoice/>']],
            $this->parts(),
        );
    }

    #[Test]
    public function testQueryParamsAreNotSentAsParts(): void
    {
        $this->client()->documents->createFromPdf(file: '%PDF', customerTaxID: 'BE0123', requestOptions: $this->options());

        $this->assertSame('customer_tax_id=BE0123', $this->requests[0]->getUri()->getQuery());
        $this->assertSame(
            [['disposition' => 'form-data; name="file"; filename="upload"', 'type' => 'application/octet-stream', 'content' => '%PDF']],
            $this->parts(),
        );
    }

    #[Test]
    public function testParamsObjectsAcceptBothForms(): void
    {
        $file = FileParam::fromString('bytes', filename: 'a.pdf');

        $this->assertSame('bytes', AttachmentAddParams::with(file: 'bytes')->file);
        $this->assertSame($file, AttachmentAddParams::with(file: 'bytes')->withFile($file)->file);

        $this->client()->documents->attachments->raw->add(
            'doc_1',
            params: AttachmentAddParams::with(file: $file),
            requestOptions: $this->options(),
        );
        $this->assertSame('form-data; name="file"; filename="a.pdf"', $this->parts()[0]['disposition']);
    }

    private function client(): Client
    {
        return new Client(apiKey: 'My API Key', baseUrl: 'http://localhost');
    }

    private function options(): RequestOptions
    {
        $transporter = new class($this->requests) implements ClientInterface {
            /**
             * @param list<RequestInterface> $requests
             */
            public function __construct(private array &$requests) {}

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $this->requests[] = $request;

                return new Response(200, ['Content-Type' => 'application/json'], '{}');
            }
        };

        return RequestOptions::with(transporter: $transporter);
    }

    /**
     * Decodes the multipart body of the last captured request.
     *
     * @return list<array{disposition: string, type: string, content: string}>
     */
    private function parts(): array
    {
        $request = $this->requests[array_key_last($this->requests)] ?? null;
        $this->assertNotNull($request);
        $this->assertSame(1, preg_match('/^multipart\/form-data; boundary=(.+)$/', $request->getHeaderLine('Content-Type'), $matches));

        $chunks = explode("--{$matches[1]}", (string) $request->getBody());
        $this->assertSame('', array_shift($chunks));
        $this->assertSame("--\r\n", array_pop($chunks));

        $parts = [];
        foreach ($chunks as $chunk) {
            [$head, $content] = explode("\r\n\r\n", $chunk, 2);
            $headers = [];
            foreach (explode("\r\n", trim($head)) as $line) {
                [$name, $value] = explode(': ', $line, 2);
                $headers[$name] = $value;
            }

            $parts[] = [
                'disposition' => $headers['Content-Disposition'] ?? '',
                'type' => $headers['Content-Type'] ?? '',
                'content' => substr($content, 0, -2),
            ];
        }

        return $parts;
    }
}
