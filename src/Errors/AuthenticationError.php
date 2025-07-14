<?php

namespace EInvoiceAPI\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Authentication Error';
}
