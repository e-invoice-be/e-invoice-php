<?php

namespace EInvoiceAPI\Core\Errors;

class BadRequestError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Bad Request Error';
}
