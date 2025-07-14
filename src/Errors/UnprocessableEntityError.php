<?php

namespace EInvoiceAPI\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Unprocessable Entity Error';
}
