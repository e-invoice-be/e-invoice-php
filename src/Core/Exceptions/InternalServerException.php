<?php

namespace EInvoiceAPI\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Internal Server Exception';
}
