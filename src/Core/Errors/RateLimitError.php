<?php

namespace EInvoiceAPI\Core\Errors;

class RateLimitError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Rate Limit Error';
}
