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

final class Webhooks implements WebhooksContract
{
    public function __construct(private Client $client) {}

    /**
     * @param CreateParams|array{
     *   events?: list<string>, url?: string, enabled?: bool
     * } $params
     */
    public function create(
        array|CreateParams $params,
        ?RequestOptions $requestOptions = null
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

    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
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
     * @param UpdateParams|array{
     *   enabled?: bool|null, events?: list<string>|null, url?: string|null
     * } $params
     */
    public function update(
        string $webhookID,
        array|UpdateParams $params,
        ?RequestOptions $requestOptions = null,
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
     * @return list<WebhookResponse>
     */
    public function list(?RequestOptions $requestOptions = null): array
    {
        $resp = $this->client->request(
            method: 'get',
            path: 'api/webhooks/',
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Serde::coerce(new ListOf(WebhookResponse::class), value: $resp);
    }

    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
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
