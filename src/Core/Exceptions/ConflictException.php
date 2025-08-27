<?php

namespace EInvoiceAPI\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Conflict Exception';
}
