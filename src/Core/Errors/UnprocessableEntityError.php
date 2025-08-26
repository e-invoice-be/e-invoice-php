<?php

namespace EInvoiceAPI\Core\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Unprocessable Entity Error';
}
