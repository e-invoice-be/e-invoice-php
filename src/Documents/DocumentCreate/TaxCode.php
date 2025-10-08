<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentCreate;

/**
 * Tax category code of the invoice.
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
