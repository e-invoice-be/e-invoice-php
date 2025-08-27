<?php

namespace EInvoiceAPI\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Permission Denied Exception';
}
