<?php

namespace EInvoiceAPI\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Not Found Exception';
}
