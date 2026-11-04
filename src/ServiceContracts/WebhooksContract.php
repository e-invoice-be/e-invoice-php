<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Implementation\Omit;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookGetHistoryResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookTestResponse;

use const EInvoiceAPI\Core\OMIT as omit;

interface WebhooksContract
{
    /**
     * @api
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
    ): WebhookResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @api
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
    ): WebhookResponse;

    /**
     * @api
     *
     * @return list<WebhookResponse>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): array;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDeleteResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveHistory(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetHistoryResponse;

    /**
     * @api
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
    ): WebhookTestResponse;
}
