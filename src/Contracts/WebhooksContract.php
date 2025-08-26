<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;

use const EInvoiceAPI\Core\OMIT as omit;

interface WebhooksContract
{
    /**
     * @param list<string> $events
     * @param string $url
     * @param bool $enabled
     */
    public function create(
        $events,
        $url,
        $enabled = omit,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @param bool|null $enabled
     * @param list<string>|null $events
     * @param string|null $url
     */
    public function update(
        string $webhookID,
        $enabled = omit,
        $events = omit,
        $url = omit,
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
