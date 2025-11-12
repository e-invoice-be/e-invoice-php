<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidateJsonParams;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDParams;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;
use EInvoiceAPI\Validate\ValidateValidateUblParams;

interface ValidateContract
{
    /**
     * @api
     *
     * @param array<mixed>|ValidateValidateJsonParams $params
     *
     * @throws APIException
     */
    public function validateJson(
        array|ValidateValidateJsonParams $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;

    /**
     * @api
     *
     * @param array<mixed>|ValidateValidatePeppolIDParams $params
     *
     * @throws APIException
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParams $params,
        ?RequestOptions $requestOptions = null,
    ): ValidateValidatePeppolIDResponse;

    /**
     * @api
     *
     * @param array<mixed>|ValidateValidateUblParams $params
     *
     * @throws APIException
     */
    public function validateUbl(
        array|ValidateValidateUblParams $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation;
}
