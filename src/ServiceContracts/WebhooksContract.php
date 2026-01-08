<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
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
    ): WebhookResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookResponse;

    /**
     * @api
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
    ): WebhookResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<WebhookResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookDeleteResponse;
}
