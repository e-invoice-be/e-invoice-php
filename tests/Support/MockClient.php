<?php

namespace Tests\Support;

use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * A PSR-18 client that records each request and replies with the queued responses.
 */
final class MockClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    /** @var list<ResponseInterface|ClientExceptionInterface> */
    private array $queue = [];

    public function queue(ResponseInterface|ClientExceptionInterface $next): self
    {
        $this->queue[] = $next;

        return $this;
    }

    /**
     * @param array<string,string> $headers
     */
    public function queueJson(mixed $body = [], int $status = 200, array $headers = []): self
    {
        return $this->queue(new Response(
            $status,
            ['Content-Type' => 'application/json', ...$headers],
            json_encode($body, flags: JSON_THROW_ON_ERROR),
        ));
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;

        $next = array_shift($this->queue);
        if (null === $next) {
            throw new \LogicException(sprintf('No response is queued for %s %s', $request->getMethod(), $request->getUri()));
        }
        if ($next instanceof ClientExceptionInterface) {
            throw $next;
        }

        return $next;
    }
}
