<?php

namespace EInvoiceAPI\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Permission Denied Error';
}
