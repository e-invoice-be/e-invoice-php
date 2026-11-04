<?php

namespace Tests\Core;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\CoerceState;
use EInvoiceAPI\Core\Conversion\DumpState;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Core\Conversion\MapOf;
use EInvoiceAPI\Core\Conversion\UnionOf;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Webhooks\WebhookResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ConversionCat implements BaseModel
{
    /** @use SdkModel<array<string,mixed>> */
    use SdkModel;

    #[Required]
    public string $type;

    #[Required('purr_volume')]
    public int $purrVolume;
}

final class ConversionDog implements BaseModel
{
    /** @use SdkModel<array<string,mixed>> */
    use SdkModel;

    #[Required]
    public string $type;

    #[Optional('bark_count')]
    public ?int $barkCount;

    public function __construct()
    {
        $this->initialize();
    }
}

/**
 * Coercion of API payloads into models and scalars, and the dump of values into JSON payloads.
 *
 * @internal
 */
final class ModelConversionTest extends TestCase
{
    #[Test]
    public function testUnknownFieldsOfAResponseAreKept(): void
    {
        $webhook = self::webhook(['new_field' => ['nested' => true]]);

        // @phpstan-ignore offsetAccess.notFound
        $this->assertSame(['nested' => true], $webhook['new_field']);
        $this->assertSame(['nested' => true], $webhook->jsonSerialize()['new_field'] ?? null);
    }

    #[Test]
    public function testValueOfAnotherTypeIsKeptAsRawPayload(): void
    {
        $webhook = self::webhook(['events' => 'document.received']);

        $this->assertSame('document.received', $webhook['events']);
        $this->assertSame('document.received', $webhook->jsonSerialize()['events'] ?? null);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("use the array access ['events'] syntax");

        $webhook->__get('events');
    }

    #[Test]
    public function testReadingAnUnknownPropertyThrows(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Property 'nope' does not exist");

        self::webhook()->__get('nope');
    }

    /**
     * The message names the class, never the model's data: a `WebhookResponse` holds the webhook secret.
     */
    #[Test]
    public function testErrorForAnUnknownPropertyNamesTheClassAndNotTheData(): void
    {
        try {
            self::webhook()->__get('nope');
            $this->fail('The model did not throw.');
        } catch (\RuntimeException $e) {
            $this->assertStringContainsString(WebhookResponse::class, $e->getMessage());
            $this->assertStringNotContainsString('top-secret', $e->getMessage());
        }
    }

    #[Test]
    public function testModelIsPrintedAsPrettyJson(): void
    {
        $webhook = self::webhook();

        $this->assertSame(
            ['id' => 'wh_1', 'events' => ['document.received'], 'secret' => 'top-secret', 'url' => 'https://example.com/hook', 'enabled' => true],
            json_decode((string) $webhook, associative: true, flags: JSON_THROW_ON_ERROR),
        );
        $this->assertStringContainsString("\n", (string) $webhook);
        $this->assertSame($webhook->__serialize(), $webhook->__debugInfo());
    }

    #[Test]
    public function testUnsetPropertyIsOmittedFromTheDump(): void
    {
        $webhook = self::webhook();
        $this->assertTrue(isset($webhook['enabled']));

        unset($webhook['enabled']);

        $this->assertFalse(isset($webhook['enabled']));
        $this->assertNull($webhook->enabled);
        $this->assertArrayNotHasKey('enabled', $webhook->jsonSerialize());
    }

    #[Test]
    public function testPhpSerializationKeepsTheModel(): void
    {
        $webhook = self::webhook(['new_field' => 1]);

        $copy = unserialize(serialize($webhook));

        $this->assertInstanceOf(WebhookResponse::class, $copy);
        $this->assertEquals($webhook->jsonSerialize(), $copy->jsonSerialize());
        // @phpstan-ignore offsetAccess.notFound
        $this->assertSame(1, $copy['new_field']);
    }

    #[Test]
    public function testNonStringOffsetIsRejected(): void
    {
        $webhook = self::webhook();

        $this->expectException(\InvalidArgumentException::class);

        // @phpstan-ignore offsetAccess.notFound
        $unused = $webhook[0];
        $this->fail('Unexpected value '.get_debug_type($unused));
    }

    #[Test]
    public function testDumpUsesTheApiNamesAndOmitsUnsetOptionals(): void
    {
        $dog = new ConversionDog;
        $dog['type'] = 'dog';

        $this->assertSame(['type' => 'dog'], $dog->jsonSerialize());

        $dog['barkCount'] = 3;
        $this->assertSame(['type' => 'dog', 'bark_count' => 3], $dog->jsonSerialize());
    }

    #[Test]
    public function testMissingRequiredFieldMakesTheModelLessLikely(): void
    {
        $state = new CoerceState;
        $cat = Conversion::coerce(ConversionCat::class, value: ['type' => 'cat'], state: $state);

        $this->assertInstanceOf(ConversionCat::class, $cat);
        $this->assertSame(1, $state->no);
        $this->assertFalse(isset($cat['purrVolume']));
    }

    /**
     * Because `offsetGet()` returns by reference, an absent field must be returned through a
     * variable; returning the literal `null` raises "Only variable references should be returned
     * by reference", which strict error handlers (as in many frameworks) turn into an exception.
     */
    #[Test]
    public function testReadingAnAbsentFieldRaisesNoNotice(): void
    {
        $webhook = self::webhook();
        unset($webhook['enabled']);

        set_error_handler(static function (int $errno, string $errstr): never {
            throw new \ErrorException($errstr, 0, $errno);
        });

        try {
            $this->assertNull($webhook['enabled']);
        } finally {
            restore_error_handler();
        }
    }

    #[Test]
    public function testListIsNotCoercedToAModel(): void
    {
        $state = new CoerceState;

        $this->assertSame(['a', 'b'], Conversion::coerce(ConversionCat::class, value: ['a', 'b'], state: $state));
        $this->assertSame(1, $state->no);
    }

    #[Test]
    public function testDiscriminatorSelectsTheVariant(): void
    {
        $union = new UnionOf(['cat' => ConversionCat::class, 'dog' => ConversionDog::class], discriminator: 'type');

        $cat = Conversion::coerce($union, value: ['type' => 'cat', 'purr_volume' => 7]);
        $dog = Conversion::coerce($union, value: ['type' => 'dog', 'bark_count' => 2]);

        $this->assertInstanceOf(ConversionCat::class, $cat);
        $this->assertSame(7, $cat->purrVolume);
        $this->assertInstanceOf(ConversionDog::class, $dog);
        $this->assertSame(2, $dog->barkCount);
        $this->assertSame(['type' => 'cat', 'purr_volume' => 7], Conversion::dump($union, value: $cat));
    }

    #[Test]
    public function testWithoutDiscriminatorTheBestVariantIsChosen(): void
    {
        $union = new UnionOf([ConversionCat::class, ConversionDog::class]);

        $this->assertInstanceOf(ConversionCat::class, Conversion::coerce($union, value: ['type' => 'x', 'purr_volume' => 1]));
        $this->assertInstanceOf(ConversionDog::class, Conversion::coerce($union, value: ['type' => 'x', 'bark_count' => 1]));
        $this->assertSame('neither', Conversion::coerce($union, value: 'neither'));
    }

    #[Test]
    public function testUnknownDiscriminatorFallsBackToTheBestVariant(): void
    {
        $union = new UnionOf(['cat' => ConversionCat::class, 'dog' => ConversionDog::class], discriminator: 'type');

        $this->assertInstanceOf(ConversionDog::class, Conversion::coerce($union, value: ['type' => 'bird']));
        $this->assertInstanceOf(ConversionDog::class, Conversion::coerce($union, value: ['type' => 1]));
    }

    #[Test]
    public function testScalarUnionKeepsTheTypeOfTheValue(): void
    {
        $union = new UnionOf(['int', 'string']);

        $this->assertSame(5, Conversion::coerce($union, value: 5));
        $this->assertSame('abc', Conversion::coerce($union, value: 'abc'));
        $this->assertSame('12', Conversion::dump($union, value: '12'));
    }

    #[Test]
    #[DataProvider('scalarCoercions')]
    public function testScalarCoercion(string $type, mixed $value, mixed $expected): void
    {
        $this->assertSame($expected, Conversion::coerce($type, value: $value));
    }

    /**
     * @return iterable<string,array{string,mixed,mixed}>
     */
    public static function scalarCoercions(): iterable
    {
        yield 'int from int' => ['int', 3, 3];

        yield 'int from float' => ['int', 3.0, 3];

        yield 'int from digits' => ['int', '42', 42];

        yield 'int keeps other strings' => ['int', '4.2', '4.2'];

        yield 'float from int' => ['float', 3, 3.0];

        yield 'float from numeric string' => ['float', '1.25', 1.25];

        yield 'float keeps other strings' => ['float', 'abc', 'abc'];

        yield 'string from int' => ['string', 7, '7'];

        yield 'string keeps arrays' => ['string', ['a'], ['a']];

        yield 'bool keeps bools' => ['bool', false, false];

        yield 'bool keeps strings' => ['bool', 'true', 'true'];

        yield 'null from anything' => ['null', 'x', null];

        yield 'mixed keeps the value' => ['mixed', ['a' => 1], ['a' => 1]];
    }

    #[Test]
    public function testStringIsReadFromAGenerator(): void
    {
        $chunks = (static function () {
            yield 'ab';

            yield 1;

            yield null;

            yield 'c';
        })();

        $this->assertSame('ab1c', Conversion::coerce('string', value: $chunks));
    }

    #[Test]
    public function testGeneratorOfArraysIsNotAString(): void
    {
        $chunks = (static function () {
            yield ['a'];
        })();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected generator to yield stringable chunks, got array');

        Conversion::coerce('string', value: $chunks);
    }

    #[Test]
    public function testDumpOfUnknownValues(): void
    {
        $json = new class() implements \JsonSerializable {
            public function jsonSerialize(): mixed
            {
                return ['json' => true];
            }
        };
        $plain = new class() {
            public string $a = 'x';

            /** @var list<DocumentType> */
            public array $types = [DocumentType::INVOICE];
        };
        $state = new DumpState;

        $this->assertSame('INVOICE', Conversion::dump_unknown(DocumentType::INVOICE, state: $state));
        $this->assertSame(['json' => true], Conversion::dump_unknown($json, state: $state));
        $this->assertSame(['a' => 'x', 'types' => ['INVOICE']], Conversion::dump_unknown($plain, state: $state));
        $this->assertEquals(new \stdClass, Conversion::dump_unknown(new \stdClass, state: $state));
        $this->assertSame(
            '2024-01-31T10:15:30.000000+00:00',
            Conversion::dump_unknown(new \DateTimeImmutable('2024-01-31T10:15:30Z'), state: $state),
        );
    }

    #[Test]
    public function testEmptyListIsAJsonArrayAndEmptyMapAJsonObject(): void
    {
        $this->assertSame('[]', json_encode(Conversion::dump(new ListOf('string'), value: [])));
        $this->assertSame('{}', json_encode(Conversion::dump(new MapOf('string'), value: [])));
        $this->assertSame(['a', 'b'], Conversion::dump(new ListOf('string'), value: ['a', 'b']));
        $this->assertSame(['k' => 'v'], Conversion::dump(new MapOf('string'), value: ['k' => 'v']));
    }

    /**
     * @param array<string,mixed> $extra
     */
    private static function webhook(array $extra = []): WebhookResponse
    {
        $webhook = Conversion::coerce(WebhookResponse::class, value: [
            'id' => 'wh_1',
            'events' => ['document.received'],
            'secret' => 'top-secret',
            'url' => 'https://example.com/hook',
            'enabled' => true,
            ...$extra,
        ]);
        self::assertInstanceOf(WebhookResponse::class, $webhook);

        return $webhook;
    }
}
