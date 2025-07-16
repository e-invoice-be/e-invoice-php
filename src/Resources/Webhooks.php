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
     * @param array{events?: list<string>, url?: string, enabled?: bool} $params
     */
    public function create(
        array $params,
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

    /**
     * @param array{webhookID?: string} $params
     */
    public function retrieve(
        string $webhookID,
        array $params,
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
     * @param array{
     *   webhookID?: string,
     *   enabled?: bool|null,
     *   events?: list<string>|null,
     *   url?: string|null,
     * } $params
     */
    public function update(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
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
     *
     * @return list<WebhookResponse>
     */
    public function list(
        array $params,
        ?RequestOptions $requestOptions = null
    ): array {
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
     */
    public function delete(
        string $webhookID,
        array $params,
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
