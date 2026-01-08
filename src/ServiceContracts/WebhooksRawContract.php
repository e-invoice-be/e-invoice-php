<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Webhooks\WebhookCreateParams;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface WebhooksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookResponse>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebhookUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookResponse>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<WebhookResponse>>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
