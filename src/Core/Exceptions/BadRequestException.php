<?php

namespace EInvoiceAPI\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Bad Request Exception';
}
