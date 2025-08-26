<?php

namespace EInvoiceAPI\Core\Errors;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class APIError extends EInvoiceAPIError
{
    public ?int $status = null;

    public mixed $body = null;

    public ?ResponseInterface $response = null;

    public function __construct(
        public RequestInterface $request,
        ?\Throwable $previous = null,
        string $message = '',
    ) {
        parent::__construct(message: $message, previous: $previous);
    }
}
