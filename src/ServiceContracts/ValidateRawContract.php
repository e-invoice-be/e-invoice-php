<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidateJsonParams;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDParams;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;
use EInvoiceAPI\Validate\ValidateValidateUblParams;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface ValidateRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ValidateValidateJsonParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validateJson(
        array|ValidateValidateJsonParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ValidateValidatePeppolIDParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ValidateValidatePeppolIDResponse>
     *
     * @throws APIException
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ValidateValidateUblParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validateUbl(
        array|ValidateValidateUblParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
