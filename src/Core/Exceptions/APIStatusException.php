<?php

namespace EInvoiceAPI\Core\Exceptions;

use EInvoiceAPI\Core\Util;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class APIStatusException extends APIException
{
    /** @var string */
    protected const DESC = 'EInvoiceAPI API Status Error';

    public ?int $status;

    public function __construct(
        public RequestInterface $request,
        ResponseInterface $response,
        ?\Throwable $previous = null,
        string $message = '',
    ) {
        $this->response = $response;
        $this->status = $response->getStatusCode();
        $this->body = self::decodeBody($response);

        $summary = Util::prettyEncodeJson(['status' => $this->status, 'body' => $this->body]);

        if ('' !== $message) {
            $summary = $message.PHP_EOL.$summary;
        }

        parent::__construct(request: $request, message: $summary, previous: $previous);
    }

    public static function from(
        RequestInterface $request,
        ResponseInterface $response,
        string $message = ''
    ): self {
        $status = $response->getStatusCode();

        $cls = match (true) {
            400 === $status => BadRequestException::class,
            401 === $status => AuthenticationException::class,
            403 === $status => PermissionDeniedException::class,
            404 === $status => NotFoundException::class,
            409 === $status => ConflictException::class,
            422 === $status => UnprocessableEntityException::class,
            429 === $status => RateLimitException::class,
            $status >= 500 => InternalServerException::class,
            default => APIStatusException::class
        };

        return new $cls(request: $request, response: $response, message: $message);
    }

    /**
     * Decodes the error body: `{"detail": "..."}` for most errors, or
     * `{"detail": [{"loc": [...], "msg": "...", "type": "..."}]}` for a 422
     * validation error. A body that is not JSON is kept as a string, and an
     * empty body is `null`.
     */
    private static function decodeBody(ResponseInterface $response): mixed
    {
        $raw = (string) $response->getBody();

        if ('' === $raw) {
            return null;
        }

        try {
            return Util::decodeJson($raw);
        } catch (\JsonException) {
            return $raw;
        }
    }
}
