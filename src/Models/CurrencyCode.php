<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Concerns\Enum;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;

final class CurrencyCode implements ConverterSource
{
    use Enum;

    final public const EUR = 'EUR';

    final public const USD = 'USD';

    final public const GBP = 'GBP';

    final public const JPY = 'JPY';

    final public const CHF = 'CHF';

    final public const CAD = 'CAD';

    final public const AUD = 'AUD';

    final public const NZD = 'NZD';

    final public const CNY = 'CNY';

    final public const INR = 'INR';

    final public const SEK = 'SEK';

    final public const NOK = 'NOK';

    final public const DKK = 'DKK';

    final public const SGD = 'SGD';

    final public const HKD = 'HKD';
}
