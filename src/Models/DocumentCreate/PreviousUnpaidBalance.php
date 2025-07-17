<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentCreate;

use EInvoiceAPI\Core\Concerns\Union;
use EInvoiceAPI\Core\Contracts\StaticConverter;

final class PreviousUnpaidBalance implements StaticConverter
{
    use Union;
}
