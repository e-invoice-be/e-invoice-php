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
        $rsp = $this->sendRequest($opts, req: $request, data: $body, redirectCount: 0, retryCount: 0);

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

        $req = ['method' => strtoupper($method), 'path' => $uri, 'query' => $mergedQuery, 'headers' => $mergedHeaders, 'body' => $body];

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
        if (!$location) {
            throw new APIConnectionException($req, message: 'Redirection without Location header');
        }

        $uri = Util::joinUri($req->getUri(), path: $location);

        return $req->withUri($uri);
    }

    /**
     * @internal
     */
    protected function shouldRetry(
        RequestOptions $opts,
        int $retryCount,
        ?ResponseInterface $rsp
    ): bool {
        if ($retryCount >= $opts->maxRetries) {
            return false;
        }

        $code = $rsp?->getStatusCode();
        if (408 == $code || 409 == $code || 429 == $code || $code >= 500) {
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

        $req = Util::withSetBody($opts->streamFactory, req: $req, body: $data);

        $rsp = null;
        $err = null;

        try {
            $rsp = $opts->transporter->sendRequest($req);
        } catch (ClientExceptionInterface $e) {
            $err = $e;
        }

        $code = $rsp?->getStatusCode();

        if ($code >= 300 && $code < 400) {
            assert(!is_null($rsp));

            if ($redirectCount >= 20) {
                throw new APIConnectionException($req, message: 'Maximum redirects exceeded');
            }

            $req = $this->followRedirect($rsp, req: $req);

            return $this->sendRequest($opts, req: $req, data: $data, retryCount: $retryCount, redirectCount: ++$redirectCount);
        }

        if ($code >= 400 || is_null($rsp)) {
            if (!$this->shouldRetry($opts, retryCount: $retryCount, rsp: $rsp)) {
                if (!is_null($rsp)) {
                    throw APIStatusException::from(request: $req, response: $rsp);
                }

                throw self::isTimeout($err) ? new APITimeoutException($req, previous: $err) : new APIConnectionException($req, previous: $err);
            }

            $seconds = $this->retryDelay($opts, retryCount: $retryCount, rsp: $rsp);
            $this->sleep($seconds);

            return $this->sendRequest($opts, req: $req, data: $data, retryCount: ++$retryCount, redirectCount: $redirectCount);
        }

        return $rsp;
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
     * PSR-18 has no timeout exception, so the message of the HTTP client must tell.
     */
    private static function isTimeout(?\Throwable $err): bool
    {
        for (; !is_null($err); $err = $err->getPrevious()) {
            // Some clients put the request URL in the message.
            $message = preg_replace('/\S+:\/\/\S+/', '', $err->getMessage()) ?? '';
            if (preg_match('/\btime(?:d[ -]?| |-)?out\b/i', $message)) {
                return true;
            }
        }

        return false;
    }
}
