<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Implementation\Omit;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\WebhooksContract;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookGetHistoryResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookTestResponse;

use const EInvoiceAPI\Core\OMIT as omit;

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
     *
     * @throws APIException
     */
    public function create(
        array $events,
        string $url,
        bool $enabled = true,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse {
        $params = ['events' => $events, 'url' => $url, 'enabled' => $enabled];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
        $response = $this->raw->retrieve($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a webhook by ID
     *
     * Leave a param out to keep its current value, or pass `null` to send an
     * explicit `null` for it.
     *
     * @param list<string>|Omit|null $events
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        bool|Omit|null $enabled = omit,
        array|Omit|null $events = omit,
        string|Omit|null $url = omit,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse {
        $params = [];
        omit !== $enabled && $params['enabled'] = $enabled;
        omit !== $events && $params['events'] = $events;
        omit !== $url && $params['url'] = $url;

        $response = $this->raw->update($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
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
        $response = $this->raw->delete($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the history of a webhook
     *
     * @throws APIException
     */
    public function retrieveHistory(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetHistoryResponse {
        $response = $this->raw->retrieveHistory($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send a test event to a webhook for testing and debugging purposes
     *
     * @param array<string,mixed> $data Custom event data payload
     * @param string $eventType Must be valid WebhookEventType
     *
     * @throws APIException
     */
    public function test(
        string $webhookID,
        array $data,
        string $eventType,
        ?RequestOptions $requestOptions = null,
    ): WebhookTestResponse {
        $params = ['data' => $data, 'eventType' => $eventType];

        $response = $this->raw->test($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
