<?php

namespace EInvoiceAPI\Errors;

class RateLimitError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Rate Limit Error';
}
