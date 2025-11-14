<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate\Item\Allowance;

/**
 * The VAT category code that applies to the allowance.
 */
enum TaxCode: string
{
    case AE = 'AE';

    case E = 'E';

    case S = 'S';

    case Z = 'Z';

    case G = 'G';

    case O = 'O';

    case K = 'K';

    case L = 'L';

    case M = 'M';

    case B = 'B';
}
