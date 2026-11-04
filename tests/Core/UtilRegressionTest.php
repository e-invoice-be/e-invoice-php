<?php

namespace Tests\Core;

use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Core\Util;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Uri;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversNothing]
class UtilRegressionTest extends TestCase
{
    #[Test]
    public function testJoinUriKeepsThePasswordOfTheUserInfo(): void
    {
        $uri = Util::joinUri(new Uri('https://api.example.com'), 'https://user:secret@other.example.com/x');

        $this->assertSame('user:secret', $uri->getUserInfo());
        $this->assertSame('other.example.com', $uri->getHost());
        $this->assertSame('/x', $uri->getPath());
    }

    #[Test]
    public function testJoinUriKeepsAPathOfZero(): void
    {
        $uri = Util::joinUri(new Uri('https://api.example.com/api'), '0');

        $this->assertSame('/api/0', $uri->getPath());
    }

    #[Test]
    public function testMultipartResourceWhoseContentIsZeroIsSent(): void
    {
        $resource = fopen('php://memory', 'r+');
        $this->assertNotFalse($resource);
        fwrite($resource, '0');
        rewind($resource);

        $body = $this->multipartBody(['file' => FileParam::fromResource($resource, filename: 'zero.txt')]);

        $this->assertStringContainsString("Content-Type: application/octet-stream\r\n\r\n0\r\n", $body);
    }

    #[Test]
    public function testMultipartBodyWithIntegerKeysIsEncoded(): void
    {
        $body = $this->multipartBody(['a', 'b']);

        $this->assertStringContainsString("Content-Disposition: form-data; name=\"0\"\r\nContent-Type: text/plain\r\n\r\na\r\n", $body);
        $this->assertStringContainsString("Content-Disposition: form-data; name=\"1\"\r\nContent-Type: text/plain\r\n\r\nb\r\n", $body);
    }

    /**
     * @param array<mixed> $body
     */
    private function multipartBody(array $body): string
    {
        $factory = new Psr17Factory;
        $request = $factory->createRequest('POST', 'https://api.example.com')->withHeader('Content-Type', 'multipart/form-data');

        // @phpstan-ignore argument.type (a list body, which the SDK itself does not build)
        return (string) Util::withSetBody($factory, $request, $body)->getBody();
    }
}
