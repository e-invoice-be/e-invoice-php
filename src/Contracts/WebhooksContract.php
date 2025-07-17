<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DeleteResponse;
use EInvoiceAPI\Models\WebhookResponse;
use EInvoiceAPI\Parameters\WebhookCreateParam;
use EInvoiceAPI\Parameters\WebhookUpdateParam;
use EInvoiceAPI\RequestOptions;

interface WebhooksContract
{
    /**
     * @param WebhookCreateParam|array{
     *   events?: list<string>, url?: string, enabled?: bool
     * } $params
     */
    public function create(
        array|WebhookCreateParam $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @param WebhookUpdateParam|array{
     *   enabled?: bool|null, events?: list<string>|null, url?: string|null
     * } $params
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParam $params,
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
    ): DeleteResponse;
}
