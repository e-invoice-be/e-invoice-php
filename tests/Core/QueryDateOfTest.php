<?php

namespace Tests\Core;

use EInvoiceAPI\Core\Conversion\CoerceState;
use EInvoiceAPI\Core\Conversion\DumpState;
use EInvoiceAPI\Core\Conversion\QueryDateOf;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class QueryDateOfTest extends TestCase
{
    #[Test]
    public function testCoerceKeepsStringsAndDates(): void
    {
        $converter = new QueryDateOf;
        $date = new \DateTimeImmutable('2019-12-27');
        $state = new CoerceState;

        $this->assertSame('2019-12-27', $converter->coerce('2019-12-27', state: $state));
        $this->assertSame($date, $converter->coerce($date, state: $state));
        $this->assertSame(2, $state->yes);
        $this->assertSame(0, $state->no);
    }

    #[Test]
    public function testCoerceTreatsOtherValuesAsStrings(): void
    {
        $this->assertSame('20191227', (new QueryDateOf)->coerce(20191227, state: new CoerceState));
    }

    #[Test]
    public function testDumpFormatsDatesAsTheirCalendarDate(): void
    {
        $converter = new QueryDateOf;
        $state = new DumpState;

        $this->assertSame('2019-12-27', $converter->dump(new \DateTimeImmutable('2019-12-27T23:30:00-05:00'), state: $state));
        $this->assertSame('2019-12-27', $converter->dump('2019-12-27', state: $state));
        $this->assertSame('2019-12-01', $converter->dump(new \DateTime('2019-12-01'), state: $state));
        $this->assertNull($converter->dump(null, state: $state));
    }
}
