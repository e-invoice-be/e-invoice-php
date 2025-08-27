<?php

namespace EInvoiceAPI\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Authentication Exception';
}
