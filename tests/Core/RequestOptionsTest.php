<?php

namespace Tests\Core;

use EInvoiceAPI\RequestOptions;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class RequestOptionsTest extends TestCase
{
    /**
     * The SDK cannot apply a timeout: PSR-18 has no timeout parameter. Set it on the client that you give as `transporter`.
     */
    #[Test]
    public function testHasNoTimeoutOption(): void
    {
        $reflection = new \ReflectionClass(RequestOptions::class);

        $this->assertFalse($reflection->hasProperty('timeout'));
        $this->assertFalse($reflection->hasMethod('withTimeout'));

        $parameters = array_map(
            static fn (\ReflectionParameter $p) => $p->getName(),
            $reflection->getMethod('with')->getParameters(),
        );
        $this->assertNotContains('timeout', $parameters);
    }

    #[Test]
    public function testParseRejectsTimeout(): void
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage('Unknown named parameter $timeout');

        RequestOptions::parse(['timeout' => 5.0]);
    }
}
