<?php

namespace EInvoiceAPI\Core\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Permission Denied Error';
}
