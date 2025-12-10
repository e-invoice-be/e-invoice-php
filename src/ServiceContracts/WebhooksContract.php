<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;

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
     * @param list<string>|null $events
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        ?bool $enabled = null,
        ?array $events = null,
        ?string $url = null,
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
}
