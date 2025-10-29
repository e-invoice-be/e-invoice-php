<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\WebhooksContract;
use EInvoiceAPI\Webhooks\WebhookCreateParams;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookUpdateParams;

use const EInvoiceAPI\Core\OMIT as omit;

final class WebhooksService implements WebhooksContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new webhook
     *
     * @param list<string> $events
     * @param string $url
     * @param bool $enabled
     *
     * @throws APIException
     */
    public function create(
        $events,
        $url,
        $enabled = omit,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse {
        $params = ['events' => $events, 'url' => $url, 'enabled' => $enabled];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'api/webhooks/',
            body: (object) $parsed,
            options: $options,
            convert: WebhookResponse::class,
        );
    }

    /**
     * @api
     *
     * Get a webhook by ID
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['api/webhooks/%1$s', $webhookID],
            options: $requestOptions,
            convert: WebhookResponse::class,
        );
    }

    /**
     * @api
     *
     * Update a webhook by ID
     *
     * @param bool|null $enabled
     * @param list<string>|null $events
     * @param string|null $url
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        $enabled = omit,
        $events = omit,
        $url = omit,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse {
        $params = ['enabled' => $enabled, 'events' => $events, 'url' => $url];

        return $this->updateRaw($webhookID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['api/webhooks/%1$s', $webhookID],
            body: (object) $parsed,
            options: $options,
            convert: WebhookResponse::class,
        );
    }

    /**
     * @api
     *
     * Get all webhooks for the current tenant
     *
     * @return list<WebhookResponse>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): array
    {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'api/webhooks/',
            options: $requestOptions,
            convert: new ListOf(WebhookResponse::class),
        );
    }

    /**
     * @api
     *
     * Delete a webhook
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDeleteResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['api/webhooks/%1$s', $webhookID],
            options: $requestOptions,
            convert: WebhookDeleteResponse::class,
        );
    }
}
