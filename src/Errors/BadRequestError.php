<?php

namespace EInvoiceAPI\Errors;

class BadRequestError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Bad Request Error';
}
