<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Webhooks\WebhookCreateParams;
use EInvoiceAPI\Webhooks\WebhookDeleteResponse;
use EInvoiceAPI\Webhooks\WebhookGetHistoryResponse;
use EInvoiceAPI\Webhooks\WebhookResponse;
use EInvoiceAPI\Webhooks\WebhookTestParams;
use EInvoiceAPI\Webhooks\WebhookTestResponse;
use EInvoiceAPI\Webhooks\WebhookUpdateParams;

/**
 * @phpstan-import-type WebhookCreateParamsShape from WebhookCreateParams
 * @phpstan-import-type WebhookUpdateParamsShape from WebhookUpdateParams
 * @phpstan-import-type WebhookTestParamsShape from WebhookTestParams
 */
interface WebhooksRawContract
{
    /**
     * @api
     *
     * @param WebhookCreateParamsShape|WebhookCreateParams $params
     *
     * @return BaseResponse<WebhookResponse>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<WebhookResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param WebhookUpdateParamsShape|WebhookUpdateParams $params
     *
     * @return BaseResponse<WebhookResponse>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<list<WebhookResponse>>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<WebhookDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<WebhookGetHistoryResponse>
     *
     * @throws APIException
     */
    public function retrieveHistory(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param WebhookTestParamsShape|WebhookTestParams $params
     *
     * @return BaseResponse<WebhookTestResponse>
     *
     * @throws APIException
     */
    public function test(
        string $webhookID,
        array|WebhookTestParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
