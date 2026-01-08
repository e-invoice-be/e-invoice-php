<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\WebhooksContract;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
    }

    /**
     * @api
     *
     * Create a new webhook
     *
     * @param list<string> $events
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $events,
        string $url,
        bool $enabled = true,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookResponse {
        $params = Util::removeNulls(
            ['events' => $events, 'url' => $url, 'enabled' => $enabled]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a webhook by ID
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a webhook by ID
     *
     * @param list<string>|null $events
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        ?bool $enabled = null,
        ?array $events = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookResponse {
        $params = Util::removeNulls(
            ['enabled' => $enabled, 'events' => $events, 'url' => $url]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get all webhooks for the current tenant
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<WebhookResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a webhook
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
