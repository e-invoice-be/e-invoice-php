<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DeleteResponse;
use EInvoiceAPI\Models\WebhookResponse;
use EInvoiceAPI\RequestOptions;

interface WebhooksContract
{
    /**
     * @param array{events?: list<string>, url?: string, enabled?: bool} $params
     */
    public function create(
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @param array{webhookID?: string} $params
     */
    public function retrieve(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @param array{
     *   webhookID?: string,
     *   enabled?: bool|null,
     *   events?: list<string>|null,
     *   url?: string|null,
     * } $params
     */
    public function update(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @param array{} $params
     *
     * @return list<WebhookResponse>
     */
    public function list(
        array $params,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @param array{webhookID?: string} $params
     */
    public function delete(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): DeleteResponse;
}
