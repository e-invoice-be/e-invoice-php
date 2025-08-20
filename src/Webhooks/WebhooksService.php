<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\WebhooksContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Webhooks\WebhookDeleteResponse;

final class WebhooksService implements WebhooksContract
{
    public function __construct(private Client $client) {}

    /**
     * Create a new webhook.
     *
     * @param list<string> $events
     * @param string $url
     * @param bool $enabled
     */
    public function create(
        $events,
        $url,
        $enabled = null,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            ['events' => $events, 'url' => $url, 'enabled' => $enabled],
            $requestOptions,
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

    /**
     * Get a webhook by ID.
     */
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
     * Update a webhook by ID.
     *
     * @param null|bool $enabled
     * @param null|list<string> $events
     * @param null|string $url
     */
    public function update(
        string $webhookID,
        $enabled = null,
        $events = null,
        $url = null,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            ['enabled' => $enabled, 'events' => $events, 'url' => $url],
            $requestOptions,
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
     * Get all webhooks for the current tenant.
     *
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

    /**
     * Delete a webhook.
     */
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
