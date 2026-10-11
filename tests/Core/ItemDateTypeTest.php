<?php

namespace Tests\Core;

use EInvoiceAPI\Documents\DocumentCreate;
use EInvoiceAPI\Documents\DocumentCreateParams;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Validate\ValidateValidateJsonParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-type ItemClass = class-string<DocumentCreate\Item|DocumentCreateParams\Item|DocumentNewFromPdfResponse\Item|DocumentResponse\Item|ValidateValidateJsonParams\Item>
 *
 * @internal
 *
 * @coversNothing
 */
#[CoversNothing]
class ItemDateTypeTest extends TestCase
{
    /**
     * Standalone `null` is a compile error before PHP 8.2, and the package supports PHP 8.1.
     *
     * @param ItemClass $class
     */
    #[Test]
    #[DataProvider('itemClasses')]
    public function testDateHasNoStandaloneNullNativeType(string $class): void
    {
        $reflection = new \ReflectionClass($class);

        $types = ['$date' => $reflection->getProperty('date')->getType()];
        foreach (['with', 'withDate'] as $method) {
            foreach ($reflection->getMethod($method)->getParameters() as $parameter) {
                $types["{$method}(\${$parameter->getName()})"] = $parameter->getType();
            }
        }

        $standaloneNull = array_keys(array_filter(
            $types,
            static fn (?\ReflectionType $type) => $type instanceof \ReflectionNamedType && 'null' === $type->getName(),
        ));

        $this->assertSame([], $standaloneNull);
    }

    /**
     * @param ItemClass $class
     */
    #[Test]
    #[DataProvider('itemClasses')]
    public function testItemWithoutDateSerializesWithoutDate(string $class): void
    {
        $item = (new $class)->withDescription('Widget');

        $this->assertSame(['description' => 'Widget'], $item->toProperties());
        $this->assertSame('{"description":"Widget"}', json_encode($item));
    }

    /**
     * @param ItemClass $class
     */
    #[Test]
    #[DataProvider('itemClasses')]
    public function testStaticWithAlwaysSerializesNullDate(string $class): void
    {
        $this->assertSame('{"date":null}', json_encode($class::with()));
        $this->assertSame(
            '{"date":null,"description":"Widget"}',
            json_encode($class::with(date: null, description: 'Widget')),
        );
    }

    /**
     * @param ItemClass $class
     */
    #[Test]
    #[DataProvider('itemClasses')]
    public function testWithDateNullSerializesNullDate(string $class): void
    {
        $item = (new $class)->withDescription('Widget')->withDate(null);

        $this->assertSame(['date' => null, 'description' => 'Widget'], $item->toProperties());
        $this->assertSame('{"date":null,"description":"Widget"}', json_encode($item));
    }

    /**
     * @param ItemClass $class
     */
    #[Test]
    #[DataProvider('itemClasses')]
    public function testDateFromApiPayloadIsCoercedToNull(string $class): void
    {
        $item = $class::fromArray(['date' => '2024-01-31', 'description' => 'Widget']);

        $this->assertNull($item->date);
        $this->assertSame('{"date":null,"description":"Widget"}', json_encode($item));
    }

    /**
     * @param ItemClass $class
     */
    #[Test]
    #[DataProvider('itemClasses')]
    public function testWithDateRejectsADate(string $class): void
    {
        $this->expectException(\TypeError::class);

        // @phpstan-ignore argument.type
        (new $class)->withDate('2024-01-31');
    }

    /**
     * @param ItemClass $class
     */
    #[Test]
    #[DataProvider('itemClasses')]
    public function testStaticWithRejectsADate(string $class): void
    {
        $this->expectException(\TypeError::class);

        // @phpstan-ignore argument.type
        $class::with(date: new \DateTimeImmutable('2024-01-31'));
    }

    /**
     * @return iterable<string, array{ItemClass}>
     */
    public static function itemClasses(): iterable
    {
        yield 'DocumentCreate' => [DocumentCreate\Item::class];

        yield 'DocumentCreateParams' => [DocumentCreateParams\Item::class];

        yield 'DocumentNewFromPdfResponse' => [DocumentNewFromPdfResponse\Item::class];

        yield 'DocumentResponse' => [DocumentResponse\Item::class];

        yield 'ValidateValidateJsonParams' => [ValidateValidateJsonParams\Item::class];
    }
}
