<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
 *
 * @phpstan-type unit_of_measure_code_alias = UnitOfMeasureCode::*
 */
final class UnitOfMeasureCode implements ConverterSource
{
    use Enum;

    public const UNIT_OF_MEASURE_CODE_10 = '10';

    public const UNIT_OF_MEASURE_CODE_11 = '11';

    public const UNIT_OF_MEASURE_CODE_13 = '13';

    public const UNIT_OF_MEASURE_CODE_14 = '14';

    public const UNIT_OF_MEASURE_CODE_15 = '15';

    public const UNIT_OF_MEASURE_CODE_20 = '20';

    public const UNIT_OF_MEASURE_CODE_21 = '21';

    public const UNIT_OF_MEASURE_CODE_22 = '22';

    public const UNIT_OF_MEASURE_CODE_23 = '23';

    public const UNIT_OF_MEASURE_CODE_24 = '24';

    public const UNIT_OF_MEASURE_CODE_25 = '25';

    public const UNIT_OF_MEASURE_CODE_27 = '27';

    public const UNIT_OF_MEASURE_CODE_28 = '28';

    public const UNIT_OF_MEASURE_CODE_33 = '33';

    public const UNIT_OF_MEASURE_CODE_34 = '34';

    public const UNIT_OF_MEASURE_CODE_35 = '35';

    public const UNIT_OF_MEASURE_CODE_37 = '37';

    public const UNIT_OF_MEASURE_CODE_38 = '38';

    public const UNIT_OF_MEASURE_CODE_40 = '40';

    public const UNIT_OF_MEASURE_CODE_41 = '41';

    public const UNIT_OF_MEASURE_CODE_56 = '56';

    public const UNIT_OF_MEASURE_CODE_57 = '57';

    public const UNIT_OF_MEASURE_CODE_58 = '58';

    public const UNIT_OF_MEASURE_CODE_59 = '59';

    public const UNIT_OF_MEASURE_CODE_60 = '60';

    public const UNIT_OF_MEASURE_CODE_61 = '61';

    public const UNIT_OF_MEASURE_CODE_74 = '74';

    public const UNIT_OF_MEASURE_CODE_77 = '77';

    public const UNIT_OF_MEASURE_CODE_80 = '80';

    public const UNIT_OF_MEASURE_CODE_81 = '81';

    public const UNIT_OF_MEASURE_CODE_85 = '85';

    public const UNIT_OF_MEASURE_CODE_87 = '87';

    public const UNIT_OF_MEASURE_CODE_89 = '89';

    public const UNIT_OF_MEASURE_CODE_91 = '91';

    public const UNIT_OF_MEASURE_CODE_1_I = '1I';

    public const EA = 'EA';

    public const E01 = 'E01';

    public const E07 = 'E07';

    public const E09 = 'E09';

    public const E10 = 'E10';

    public const E12 = 'E12';

    public const E14 = 'E14';

    public const E17 = 'E17';

    public const E20 = 'E20';

    public const E23 = 'E23';

    public const E25 = 'E25';

    public const E27 = 'E27';

    public const E31 = 'E31';

    public const E34 = 'E34';

    public const E35 = 'E35';

    public const E36 = 'E36';

    public const E37 = 'E37';

    public const E38 = 'E38';

    public const E39 = 'E39';

    public const E40 = 'E40';

    public const E41 = 'E41';

    public const E42 = 'E42';

    public const E43 = 'E43';

    public const E44 = 'E44';

    public const E45 = 'E45';

    public const E46 = 'E46';

    public const E47 = 'E47';

    public const E48 = 'E48';

    public const E49 = 'E49';

    public const E50 = 'E50';

    public const E51 = 'E51';

    public const E52 = 'E52';

    public const E53 = 'E53';

    public const E54 = 'E54';

    public const E55 = 'E55';

    public const E56 = 'E56';

    public const E57 = 'E57';

    public const E58 = 'E58';

    public const E60 = 'E60';

    public const E62 = 'E62';

    public const E65 = 'E65';

    public const E66 = 'E66';

    public const E67 = 'E67';

    public const E69 = 'E69';

    public const E70 = 'E70';

    public const E71 = 'E71';

    public const E73 = 'E73';

    public const E75 = 'E75';

    public const E76 = 'E76';

    public const UNIT_OF_MEASURE_CODE_2_A = '2A';

    public const UNIT_OF_MEASURE_CODE_2_B = '2B';

    public const UNIT_OF_MEASURE_CODE_2_C = '2C';

    public const ZZ = 'ZZ';

    public const NAR = 'NAR';

    public const C62 = 'C62';
}
