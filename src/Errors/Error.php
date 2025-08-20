<?php

namespace EInvoiceAPI\Errors;

class Error extends \Exception
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI Error';

    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($this::DESC.PHP_EOL.$message, $code, $previous);
    }
}
