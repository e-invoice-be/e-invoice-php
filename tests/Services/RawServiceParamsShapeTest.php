<?php

namespace Tests\Services;

use EInvoiceAPI\Documents\DocumentCreateParams;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance\ReasonCode;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance\TaxCode;
use EInvoiceAPI\Documents\UnitOfMeasureCode;
use EInvoiceAPI\Drafts\DraftListParams;
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

        // At least every method with params at the time of writing, so a change in the docblock format cannot make this test pass vacuously.
        $this->assertGreaterThanOrEqual(25, $checked);
    }

    #[Test]
    public function testParamsAcceptTheValuesTheirShapesAllow(): void
    {
        // Date strings, enum objects and nested item arrays, which the shapes accept besides dates and enum values.
        [$parsed] = DocumentCreateParams::parseRequest([
            'dueDate' => '2024-01-31',
            'allowances' => [['reasonCode' => ReasonCode::_41, 'taxCode' => TaxCode::S]],
            'items' => [[
                'allowances' => [['amount' => '1.00']],
                'date' => '2024-01-15',
                'unit' => UnitOfMeasureCode::_10,
            ]],
        ], null);

        $this->assertSame('2024-01-31', $parsed['due_date']);
        $this->assertSame([['reason_code' => '41', 'tax_code' => 'S']], $parsed['allowances']);
        $this->assertSame([[
            'allowances' => [['amount' => '1.00']],
            'date' => '2024-01-15',
            'unit' => '10',
        ]], $parsed['items']);

        [$parsed] = DraftListParams::parseRequest(['dateFrom' => '2024-01-01', 'dateTo' => '2024-01-31'], null);

        $this->assertSame(['dateFrom' => '2024-01-01', 'dateTo' => '2024-01-31'], $parsed);
    }
}
