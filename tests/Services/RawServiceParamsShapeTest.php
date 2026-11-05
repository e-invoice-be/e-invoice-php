<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * The raw services document `$params` with the `*ParamsShape` type of their params class, imported the way their
 * contract imports it, so the accepted keys are written once, in the params class.
 *
 * @internal
 */
final class RawServiceParamsShapeTest extends TestCase
{
    #[Test]
    public function testRawServicesImportTheParamsShapeInsteadOfRepeatingIt(): void
    {
        $files = [
            ...glob(__DIR__.'/../../src/Services/*RawService.php') ?: [],
            ...glob(__DIR__.'/../../src/Services/*/*RawService.php') ?: [],
        ];
        $this->assertNotEmpty($files);

        $checked = 0;
        foreach ($files as $file) {
            $source = (string) file_get_contents($file);
            $name = basename($file);

            $this->assertStringNotContainsString('@param array{', $source, "{$name} repeats a params shape inline");

            preg_match_all('/@param (\S+)\|(\w+Params) \$params/', $source, $matches, PREG_SET_ORDER);
            foreach ($matches as [, $type, $class]) {
                $this->assertSame("{$class}Shape", $type, "{$name} documents \$params of {$class} without its shape");
                $this->assertStringContainsString(
                    "@phpstan-import-type {$class}Shape from {$class}",
                    $source,
                    "{$name} does not import {$class}Shape",
                );
                ++$checked;
            }
        }

        // Every method with params, so a change in the docblock format cannot make this test pass vacuously.
        $this->assertSame(25, $checked);
    }
}
