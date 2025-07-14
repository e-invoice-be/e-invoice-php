<?php

namespace EInvoiceAPI\Errors;

class NotFoundError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Not Found Error';
}
