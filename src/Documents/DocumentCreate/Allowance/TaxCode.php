<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate\Allowance;

/**
 * Duty or tax or fee category codes (Subset of UNCL5305).
 *
 * Agency: UN/CEFACT
 * Version: D.16B
 * Subset: OpenPEPPOL
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
