<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event;

enum Source: string
{
    case PEPPOL_MLR = 'peppol:mlr';

    case PEPPOL_MLS = 'peppol:mls';

    case PEPPOL_IMR = 'peppol:imr';

    case FR_SUPERPDP = 'fr:superpdp';

    case LOCAL = 'local';
}
