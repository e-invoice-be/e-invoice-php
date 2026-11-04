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
 * @phpstan-import-type ValidateValidateJsonParamsShape from ValidateValidateJsonParams
 * @phpstan-import-type ValidateValidatePeppolIDParamsShape from ValidateValidatePeppolIDParams
 * @phpstan-import-type ValidateValidateUblParamsShape from ValidateValidateUblParams
 */
interface ValidateRawContract
{
    /**
     * @api
     *
     * @param ValidateValidateJsonParamsShape|ValidateValidateJsonParams $params
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validateJson(
        array|ValidateValidateJsonParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param ValidateValidatePeppolIDParamsShape|ValidateValidatePeppolIDParams $params
     *
     * @return BaseResponse<ValidateValidatePeppolIDResponse>
     *
     * @throws APIException
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param ValidateValidateUblParamsShape|ValidateValidateUblParams $params
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validateUbl(
        array|ValidateValidateUblParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
