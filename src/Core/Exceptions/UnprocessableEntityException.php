<?php

namespace EInvoiceAPI\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Unprocessable Entity Exception';
}
