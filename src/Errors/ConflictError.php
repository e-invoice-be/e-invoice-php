<?php

namespace EInvoiceAPI\Errors;

class ConflictError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Conflict Error';
}
