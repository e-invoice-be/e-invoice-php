<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentCreate\TaxDetail;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class Amount implements StaticConverter
{
    use Union;
}
