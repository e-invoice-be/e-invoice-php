<?php

namespace Tests\Services;

use EInvoiceAPI\Me\MeGetResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
#[CoversNothing]
final class MeTest extends ServiceTestCase
{
    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson(['name' => 'Acme', 'credit_balance' => 12, 'plan' => 'starter']);

        $result = $this->client->me->retrieve(requestOptions: $this->options());

        $this->assertRequest('GET', '/api/me/');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MeGetResponse::class, $result);
        $this->assertSame('Acme', $result->name);
        $this->assertSame(12, $result->creditBalance);
        $this->assertSame('starter', $result->plan);
    }

    #[Test]
    public function testRetrieveWithOnlyRequiredFields(): void
    {
        $this->http->queueJson(['name' => 'Acme']);

        $result = $this->client->me->retrieve(requestOptions: $this->options());

        $this->assertSame('Acme', $result->name);
        $this->assertNull($result->creditBalance);
        $this->assertNull($result->plan);
    }
}
