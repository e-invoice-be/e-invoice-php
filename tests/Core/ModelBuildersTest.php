<?php

namespace Tests\Core;

use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Contracts\BasePage;
use EInvoiceAPI\RequestOptions;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * The builders of each model and params class: `with()` sets one property for each argument,
 * and `withX()` returns a copy in which only the property `x` is set. Pages, which the client
 * builds from a response, and `RequestOptions`, which `RequestBuildingTest` covers, are left out.
 *
 * @internal
 */
final class ModelBuildersTest extends TestCase
{
    /**
     * @param class-string<BaseModel> $class
     */
    #[Test]
    #[DataProvider('models')]
    public function testWithSetsOnePropertyForEachArgument(string $class): void
    {
        $with = new \ReflectionMethod($class, 'with');

        $args = [];
        foreach ($with->getParameters() as $parameter) {
            $args[$parameter->getName()] = self::sample($parameter->getType());
        }

        $model = $with->invokeArgs(null, $args);

        $this->assertInstanceOf($class, $model);
        $this->assertSame(
            self::normalize(array_keys($args)),
            self::normalize(array_keys($model->toProperties())),
        );
        $this->assertIsArray($model->jsonSerialize());
        $this->assertCount(count($args), $model->jsonSerialize());
    }

    /**
     * @param class-string<BaseModel> $class
     */
    #[Test]
    #[DataProvider('models')]
    public function testWithersSetTheirPropertyOnACopy(string $class): void
    {
        $withers = array_filter(
            (new \ReflectionClass($class))->getMethods(\ReflectionMethod::IS_PUBLIC),
            static fn (\ReflectionMethod $m) => !$m->isStatic() && str_starts_with($m->getName(), 'with') && 1 === $m->getNumberOfParameters(),
        );
        if ([] === $withers) {
            $this->assertCount(0, (new \ReflectionMethod($class, 'with'))->getParameters());

            return;
        }

        foreach ($withers as $wither) {
            $original = new $class;
            $before = $original->toProperties();

            $copy = $wither->invoke($original, self::sample($wither->getParameters()[0]->getType()));

            $this->assertInstanceOf($class, $copy);
            $this->assertNotSame($original, $copy);
            $this->assertSame($before, $original->toProperties(), "{$wither->getName()} changed the original.");

            $added = array_keys(array_diff_key($copy->toProperties(), $before));
            $this->assertSame(
                [strtolower(substr($wither->getName(), 4))],
                self::normalize($added),
                "{$class}::{$wither->getName()} did not set its own property.",
            );
        }
    }

    /**
     * @return iterable<string,array{class-string<BaseModel>}>
     */
    public static function models(): iterable
    {
        $src = dirname(__DIR__, 2).'/src';
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($src, \FilesystemIterator::SKIP_DOTS));

        $classes = [];
        foreach ($files as $file) {
            if (!$file instanceof \SplFileInfo || 'php' !== $file->getExtension()) {
                continue;
            }

            $relative = substr($file->getPathname(), strlen($src) + 1, -strlen('.php'));
            $class = 'EInvoiceAPI\\'.str_replace('/', '\\', $relative);
            if (class_exists($class) && is_subclass_of($class, BaseModel::class) && !is_subclass_of($class, BasePage::class) && RequestOptions::class !== $class) {
                $classes[] = $class;
            }
        }
        sort($classes);

        foreach ($classes as $class) {
            yield substr($class, strlen('EInvoiceAPI\\')) => [$class];
        }
    }

    /**
     * A value of the type, preferring the first type of a union that is not `null`.
     */
    private static function sample(?\ReflectionType $type): mixed
    {
        $types = $type instanceof \ReflectionUnionType ? $type->getTypes() : [$type];

        foreach ($types as $t) {
            if (!$t instanceof \ReflectionNamedType || 'null' === $t->getName()) {
                continue;
            }

            $name = $t->getName();

            switch ($name) {
                case 'string':
                    return 'x';

                case 'int':
                    return 1;

                case 'float':
                    return 1.5;

                case 'bool':
                    return true;

                case 'array':
                    return [];

                case 'mixed':
                    return 'x';
            }

            if (is_a($name, \DateTimeInterface::class, allow_string: true)) {
                return new \DateTimeImmutable('2024-01-31T10:15:30Z');
            }

            if (enum_exists($name)) {
                return $name::cases()[0];
            }

            if (is_a($name, BaseModel::class, allow_string: true)) {
                return new $name;
            }
        }

        throw new \LogicException('No sample for '.$type);
    }

    /**
     * @param list<int|string> $names
     *
     * @return list<string>
     */
    private static function normalize(array $names): array
    {
        $normalized = array_map(static fn ($n) => strtolower((string) $n), $names);
        sort($normalized);

        return $normalized;
    }
}
