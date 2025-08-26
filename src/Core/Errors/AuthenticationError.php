<?php

namespace EInvoiceAPI\Core\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Authentication Error';
}
