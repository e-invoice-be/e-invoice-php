<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Models\WebhookResponse;
use EInvoiceAPI\Models\DeleteResponse;

interface WebhooksContract
{
    /**
     * @param array{events?: list<string>, url?: string, enabled?: bool} $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function create(
        array $params,
        mixed $requestOptions = [],
    ): WebhookResponse;

    /**
     * @param array{webhookID?: string} $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function retrieve(
        string $webhookID,
        array $params,
        mixed $requestOptions = [],
    ): WebhookResponse;

    /**
     * @param array{
     *
     *       webhookID?: string,
     *       enabled?: bool|null,
     *       events?: list<string>|null,
     *       url?: string|null,
     *
     * } $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function update(
        string $webhookID,
        array $params,
        mixed $requestOptions = [],
    ): WebhookResponse;

    /**
     * @param array{} $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     *
     * @return list<WebhookResponse>
     */
    public function list(array $params, mixed $requestOptions = []): array;

    /**
     * @param array{webhookID?: string} $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function delete(
        string $webhookID,
        array $params,
        mixed $requestOptions = [],
    ): DeleteResponse;
}
