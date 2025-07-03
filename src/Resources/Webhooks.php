<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\WebhooksContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\DeleteResponse;
use EInvoiceAPI\Models\WebhookResponse;
use EInvoiceAPI\Parameters\Webhooks\CreateParams;
use EInvoiceAPI\Parameters\Webhooks\UpdateParams;
use EInvoiceAPI\RequestOptions;

class Webhooks implements WebhooksContract
{
    public function __construct(protected Client $client) {}

    /**
     * @param array{events?: list<string>, url?: string, enabled?: bool} $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function create(
        array $params,
        mixed $requestOptions = []
    ): WebhookResponse {
        [$parsed, $options] = CreateParams::parseRequest($params, $requestOptions);
        $resp = $this->client->request(
            method: 'post',
            path: 'api/webhooks/',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(WebhookResponse::class, value: $resp);
    }

    /**
     * @param array{webhookID?: string} $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function retrieve(
        string $webhookID,
        array $params,
        mixed $requestOptions = []
    ): WebhookResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/webhooks/%1$s', $webhookID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(WebhookResponse::class, value: $resp);
    }

    /**
     * @param array{
     *
     *     webhookID?: string,
     *     enabled?: bool|null,
     *     events?: list<string>|null,
     *     url?: string|null,
     *
     * } $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function update(
        string $webhookID,
        array $params,
        mixed $requestOptions = []
    ): WebhookResponse {
        [$parsed, $options] = UpdateParams::parseRequest($params, $requestOptions);
        $resp = $this->client->request(
            method: 'put',
            path: ['api/webhooks/%1$s', $webhookID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(WebhookResponse::class, value: $resp);
    }

    /**
     * @param array{} $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     *
     * @return list<WebhookResponse>
     */
    public function list(array $params, mixed $requestOptions = []): array
    {
        $resp = $this->client->request(
            method: 'get',
            path: 'api/webhooks/',
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(new ListOf(WebhookResponse::class), value: $resp);
    }

    /**
     * @param array{webhookID?: string} $params
     * @param RequestOptions|array{
     *
     *     timeout?: float|null,
     *     maxRetries?: int|null,
     *     initialRetryDelay?: float|null,
     *     maxRetryDelay?: float|null,
     *     extraHeaders?: list<string>|null,
     *     extraQueryParams?: list<string>|null,
     *     extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function delete(
        string $webhookID,
        array $params,
        mixed $requestOptions = []
    ): DeleteResponse {
        $resp = $this->client->request(
            method: 'delete',
            path: ['api/webhooks/%1$s', $webhookID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(DeleteResponse::class, value: $resp);
    }
}
