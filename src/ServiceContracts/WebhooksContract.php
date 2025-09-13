<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Implementation\HasRawResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;

use const EInvoiceAPI\Core\OMIT as omit;

interface WebhooksContract
{
    /**
     * @api
     *
     * @param list<string> $events
     * @param string $url
     * @param bool $enabled
     *
     * @return WebhookResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function create(
        $events,
        $url,
        $enabled = omit,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return WebhookResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @api
     *
     * @return WebhookResponse<HasRawResponse>
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
     * @return WebhookResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $webhookID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @api
     *
     * @param bool|null $enabled
     * @param list<string>|null $events
     * @param string|null $url
     *
     * @return WebhookResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        $enabled = omit,
        $events = omit,
        $url = omit,
        ?RequestOptions $requestOptions = null,
    ): WebhookResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return WebhookResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookResponse;

    /**
     * @api
     *
     * @return list<WebhookResponse>
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @return list<WebhookResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @return WebhookDeleteResponse<HasRawResponse>
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
     * @return WebhookDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $webhookID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): WebhookDeleteResponse;
}
