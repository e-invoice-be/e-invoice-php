<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

enum CurrencyCode: string
{
    case EUR = 'EUR';

    case USD = 'USD';

    case GBP = 'GBP';

    case JPY = 'JPY';

    case CHF = 'CHF';

    case CAD = 'CAD';

    case AUD = 'AUD';

    case NZD = 'NZD';

    case CNY = 'CNY';

    case INR = 'INR';

    case SEK = 'SEK';

    case NOK = 'NOK';

    case DKK = 'DKK';

    case SGD = 'SGD';

    case HKD = 'HKD';
}
