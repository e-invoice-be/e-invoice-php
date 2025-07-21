<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\WebhooksContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Models\WebhookResponse;
use EInvoiceAPI\Parameters\WebhookCreateParam;
use EInvoiceAPI\Parameters\WebhookUpdateParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\WebhookDeleteResponse;

final class Webhooks implements WebhooksContract
{
    public function __construct(private Client $client) {}

    /**
     * @param WebhookCreateParam|array{
     *   events: list<string>, url: string, enabled?: bool
     * } $params
     */
    public function create(
        array|WebhookCreateParam $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse {
        [$parsed, $options] = WebhookCreateParam::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'api/webhooks/',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookResponse::class, value: $resp);
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
        return Conversion::coerce(WebhookResponse::class, value: $resp);
    }

    /**
     * @param WebhookUpdateParam|array{
     *   enabled?: bool|null, events?: list<string>|null, url?: string|null
     * } $params
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParam $params,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse {
        [$parsed, $options] = WebhookUpdateParam::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: ['api/webhooks/%1$s', $webhookID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookResponse::class, value: $resp);
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
        return Conversion::coerce(new ListOf(WebhookResponse::class), value: $resp);
    }

    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDeleteResponse {
        $resp = $this->client->request(
            method: 'delete',
            path: ['api/webhooks/%1$s', $webhookID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookDeleteResponse::class, value: $resp);
    }
}
