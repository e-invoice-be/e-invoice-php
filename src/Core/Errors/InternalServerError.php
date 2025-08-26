<?php

namespace EInvoiceAPI\Core\Errors;

class InternalServerError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Internal Server Error';
}
