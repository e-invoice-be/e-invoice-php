<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\WebhookCreateParams;
use EInvoiceAPI\Models\WebhookResponse;
use EInvoiceAPI\Models\WebhookUpdateParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\WebhookDeleteResponse;

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
