<?php

namespace EInvoiceAPI\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Rate Limit Exception';
}
