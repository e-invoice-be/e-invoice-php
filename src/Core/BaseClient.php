<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core;

use EInvoiceAPI\Core\Contracts\BasePage;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;
use EInvoiceAPI\Core\Exceptions\APIConnectionException;
use EInvoiceAPI\Core\Exceptions\APIStatusException;
use EInvoiceAPI\Core\Exceptions\APITimeoutException;
use EInvoiceAPI\Core\Implementation\RawResponse;
use EInvoiceAPI\RequestOptions;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

/**
 * @phpstan-type normalized_request = array{
 *   method: string,
 *   path: string,
 *   query: array<string,mixed>,
 *   headers: array<string,string|null|list<string>>,
 *   body: mixed,
 * }
 */
abstract class BaseClient
{
    /**
     * The methods that are retried after a connection error or a timeout.
     */
    private const IDEMPOTENT_METHODS = ['GET', 'HEAD', 'PUT', 'DELETE', 'OPTIONS'];

    protected UriInterface $baseUrl;

    /**
     * @internal
     *
     * @param array<string,string|int|list<string|int>|null> $headers
     */
    public function __construct(
        protected array $headers,
        string $baseUrl,
        protected RequestOptions $options = new RequestOptions,
    ) {
        assert(!is_null($this->options->uriFactory));
        $this->baseUrl = $this->options->uriFactory->createUri($baseUrl);
    }

    /**
     * @param string|list<mixed> $path
     * @param array<string,mixed> $query
     * @param array<string,mixed> $headers
     * @param class-string<BasePage<mixed>>|null $page
     * @param RequestOptions|array<string,mixed>|null $options
     *
     * @return BaseResponse<mixed>
     */
    public function request(
        string $method,
        string|array $path,
        array $query = [],
        array $headers = [],
        mixed $body = null,
        string|Converter|ConverterSource|null $convert = null,
        ?string $page = null,
        RequestOptions|array|null $options = [],
    ): BaseResponse {
        // @phpstan-ignore-next-line
        [$req, $opts] = $this->buildRequest(method: $method, path: $path, query: $query, headers: $headers, body: $body, opts: $options);
        ['method' => $method, 'path' => $uri, 'headers' => $headers] = $req;
        assert(!is_null($opts->requestFactory));

        $request = $opts->requestFactory->createRequest($method, uri: $uri);
        $request = Util::withSetHeaders($request, headers: $headers);

        // @phpstan-ignore-next-line argument.type
        $rsp = $this->sendRequest($opts, req: $request, data: $req['body'], redirectCount: 0, retryCount: 0);

        // @phpstan-ignore-next-line argument.type
        return new RawResponse(client: $this, request: $request, response: $rsp, options: $opts, requestInfo: $req, page: $page, convert: $convert ?? 'null');
    }

    /** @return array<string,string> */
    abstract protected function authHeaders(): array;

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param array{
     *   maxRetries?: int|null,
     *   initialRetryDelay?: float|null,
     *   maxRetryDelay?: float|null,
     *   extraHeaders?: array<string,string|int|list<string|int>|null>|null,
     *   extraQueryParams?: array<string,mixed>|null,
     *   extraBodyParams?: mixed,
     *   transporter?: ClientInterface|null,
     *   uriFactory?: UriFactoryInterface|null,
     *   streamFactory?: StreamFactoryInterface|null,
     *   requestFactory?: RequestFactoryInterface|null,
     * }|null $opts
     *
     * @return array{normalized_request, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        $options = RequestOptions::parse($this->options, $opts);

        $parsedPath = Util::parsePath($path);

        /** @var array<string,mixed> $mergedQuery */
        $mergedQuery = array_merge_recursive(
            $query,
            $options->extraQueryParams ?? [],
        );
        $uri = Util::joinUri($this->baseUrl, path: $parsedPath, query: $mergedQuery)->__toString();

        /** @var array<string,string|list<string>|null> $mergedHeaders */
        $mergedHeaders = [...$this->headers,
            ...$this->authHeaders(),
            ...$headers,
            ...($options->extraHeaders ?? []), ];

        $mergedBody = self::mergeExtraBodyParams($body, extra: $options->extraBodyParams);

        $req = ['method' => strtoupper($method), 'path' => $uri, 'query' => $mergedQuery, 'headers' => $mergedHeaders, 'body' => $mergedBody];

        return [$req, $options];
    }

    /**
     * @internal
     */
    protected function followRedirect(
        ResponseInterface $rsp,
        RequestInterface $req
    ): RequestInterface {
        $location = $rsp->getHeaderLine('Location');
        if ('' === $location) {
            throw new APIConnectionException($req, message: 'Redirection without Location header');
        }

        $uri = Util::joinUri($req->getUri(), path: $location);

        return $req->withUri($uri);
    }

    /**
     * @internal
     *
     * Without a response (a connection error or a timeout), only idempotent methods
     * are retried: the first request may have reached the server, and a retry of a
     * `POST` could send a document two times. An invalid request is not retried.
     */
    protected function shouldRetry(
        RequestOptions $opts,
        RequestInterface $req,
        int $retryCount,
        ?ResponseInterface $rsp,
        ?ClientExceptionInterface $err = null
    ): bool {
        if ($retryCount >= $opts->maxRetries) {
            return false;
        }

        if (is_null($rsp)) {
            if (!self::isRetryableTransportError($err)) {
                return false;
            }

            return in_array(strtoupper($req->getMethod()), self::IDEMPOTENT_METHODS, true);
        }

        $code = $rsp->getStatusCode();
        if (408 === $code || 409 === $code || 429 === $code || $code >= 500) {
            return true;
        }

        return false;
    }

    /**
     * @internal
     *
     * The number of seconds to wait before retry number `$retryCount + 1`.
     *
     * A `Retry-After` header of more than 0 and at most 60 seconds wins. Else the
     * delay is `initialRetryDelay * 2 ** $retryCount`, at most `maxRetryDelay`,
     * minus a random jitter of up to 25%.
     *
     * @param int $retryCount the number of retries that were already done
     */
    protected function retryDelay(
        RequestOptions $opts,
        int $retryCount,
        ?ResponseInterface $rsp
    ): float {
        $retryAfter = self::parseRetryAfter($rsp?->getHeaderLine('retry-after') ?? '');
        if (!is_null($retryAfter) && $retryAfter > 0 && $retryAfter <= 60) {
            return $retryAfter;
        }

        $naive = min($opts->initialRetryDelay * 2 ** $retryCount, $opts->maxRetryDelay);
        $jitter = 1 - (0.25 * mt_rand() / mt_getrandmax());

        return max(0.0, $naive * $jitter);
    }

    /**
     * @internal
     *
     * Waits before a retry. Tests override this method, so that they stay fast.
     */
    protected function sleep(float $seconds): void
    {
        if ($seconds <= 0) {
            return;
        }

        $floor = floor($seconds);
        time_nanosleep((int) $floor, nanoseconds: min(999_999_999, (int) (($seconds - $floor) * 10 ** 9)));
    }

    /**
     * @internal
     *
     * @param bool|int|float|string|resource|\Traversable<mixed,>|array<string,mixed>|null $data
     */
    protected function sendRequest(
        RequestOptions $opts,
        RequestInterface $req,
        mixed $data,
        int $retryCount,
        int $redirectCount,
    ): ResponseInterface {
        assert(null !== $opts->streamFactory && null !== $opts->transporter);

        // Retries and redirects start again from $req, so that the body is set only
        // once: a multipart body adds its boundary to the Content-Type header.
        $sent = Util::withSetBody($opts->streamFactory, req: $req, body: $data);

        $rsp = null;
        $err = null;

        try {
            $rsp = $opts->transporter->sendRequest($sent);
        } catch (ClientExceptionInterface $e) {
            $err = $e;
        }

        $code = $rsp?->getStatusCode();

        if ($code >= 300 && $code < 400) {
            assert(!is_null($rsp));

            if ($redirectCount >= 20) {
                throw new APIConnectionException($sent, message: 'Maximum redirects exceeded');
            }

            $req = $this->followRedirect($rsp, req: $req);

            return $this->sendRequest($opts, req: $req, data: $data, retryCount: $retryCount, redirectCount: ++$redirectCount);
        }

        if ($code >= 400 || is_null($rsp)) {
            if (!$this->shouldRetry($opts, req: $req, retryCount: $retryCount, rsp: $rsp, err: $err)) {
                if (!is_null($rsp)) {
                    throw APIStatusException::from(request: $sent, response: $rsp);
                }

                throw self::isTimeout($err) ? new APITimeoutException($sent, previous: $err) : new APIConnectionException($sent, previous: $err);
            }

            $seconds = $this->retryDelay($opts, retryCount: $retryCount, rsp: $rsp);
            $this->sleep($seconds);

            return $this->sendRequest($opts, req: $req, data: $data, retryCount: ++$retryCount, redirectCount: $redirectCount);
        }

        return $rsp;
    }

    /**
     * @internal
     *
     * Adds the `extraBodyParams` request option to the body: as keys of a JSON
     * object, or as parts of a multipart body. An extra parameter overrides the
     * parameter of the same name. Without a body, the extra parameters are the body.
     *
     * A list is not a map. Merging one would add the keys `"0"`, `"1"`, … and
     * `json_encode` would turn a JSON array into an object, so a list is rejected
     * instead. An empty array is a map with no fields and is still merged.
     *
     * @throws \InvalidArgumentException when the extra parameters are not a map, or the
     *                                   body is not one
     */
    private static function mergeExtraBodyParams(mixed $body, mixed $extra): mixed
    {
        if (is_null($extra) || [] === $extra || ($extra instanceof \stdClass && [] === (array) $extra)) {
            return $body;
        }
        if (!is_array($extra) && !$extra instanceof \stdClass) {
            throw new \InvalidArgumentException('extraBodyParams must be an array or a stdClass object, got '.get_debug_type($extra));
        }
        if (is_array($extra) && array_is_list($extra)) {
            throw new \InvalidArgumentException('extraBodyParams must be a map of parameters, got a list');
        }
        if (is_null($body)) {
            return (object) $extra;
        }
        // `[]` is a list too, and a body with no fields still takes the extra parameters.
        if (is_array($body) && [] !== $body && array_is_list($body)) {
            throw new \InvalidArgumentException('extraBodyParams cannot be merged into a list body');
        }
        if (!is_array($body) && !$body instanceof \stdClass) {
            throw new \InvalidArgumentException('extraBodyParams cannot be merged into a body of type '.get_debug_type($body));
        }

        $merged = array_replace((array) $body, (array) $extra);

        return is_array($body) ? $merged : (object) $merged;
    }

    /**
     * The seconds in a `Retry-After` header: a number of seconds, or an HTTP date.
     */
    private static function parseRetryAfter(string $header): ?float
    {
        $header = trim($header);
        if ('' === $header) {
            return null;
        }

        if (is_numeric($header)) {
            return (float) $header;
        }

        // RFC 9110: senders must use the IMF-fixdate format, e.g. "Sun, 06 Nov 1994 08:49:37 GMT".
        $date = \DateTimeImmutable::createFromFormat('D, d M Y H:i:s \G\M\T', $header, new \DateTimeZone('UTC'));
        if (false === $date) {
            return null;
        }

        return (float) ($date->getTimestamp() - time());
    }

    /**
     * A missing response is retried, except when the HTTP client reports an invalid
     * request. That failure is the caller's fault and a retry cannot succeed.
     * A network exception is still retried when it is also a request exception:
     * some clients make the network exception a subclass of the request exception.
     */
    private static function isRetryableTransportError(?ClientExceptionInterface $err): bool
    {
        if ($err instanceof NetworkExceptionInterface) {
            return true;
        }

        return !$err instanceof RequestExceptionInterface;
    }

    /**
     * PSR-18 has no timeout exception, so the message of the HTTP client must tell.
     */
    private static function isTimeout(?\Throwable $err): bool
    {
        for (; !is_null($err); $err = $err->getPrevious()) {
            // Some clients put the request URL in the message.
            $message = preg_replace('/\S+:\/\/\S+/', '', $err->getMessage()) ?? '';
            if (1 === preg_match('/\btime(?:d[ -]?| |-)?out\b/i', $message)) {
                return true;
            }
        }

        return false;
    }
}
