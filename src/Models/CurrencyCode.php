<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type currency_code_alias = CurrencyCode::*
 */
final class CurrencyCode implements ConverterSource
{
    use Enum;

    public const EUR = 'EUR';

    public const USD = 'USD';

    public const GBP = 'GBP';

    public const JPY = 'JPY';

    public const CHF = 'CHF';

    public const CAD = 'CAD';

    public const AUD = 'AUD';

    public const NZD = 'NZD';

    public const CNY = 'CNY';

    public const INR = 'INR';

    public const SEK = 'SEK';

    public const NOK = 'NOK';

    public const DKK = 'DKK';

    public const SGD = 'SGD';

    public const HKD = 'HKD';
}
