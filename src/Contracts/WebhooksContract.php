<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookCreateParams;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookUpdateParams;

interface WebhooksContract
{
    /**
     * @param array{
     *   events: list<string>, url: string, enabled?: bool
     * }|WebhookCreateParams $params
     */
    public function create(
        array|WebhookCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse;

    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @param array{
     *   enabled?: null|bool, events?: null|list<string>, url?: null|string
     * }|WebhookUpdateParams $params
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse;

    /**
     * @return list<WebhookResponse>
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDeleteResponse;
}
