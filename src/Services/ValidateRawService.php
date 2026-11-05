<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\ValidateRawContract;
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
final class ValidateRawService implements ValidateRawContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Validate if the JSON document can be converted to a valid UBL document. The generated UBL is returned in ubl_document also when is_valid is false, so you can inspect it.
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
    ): BaseResponse {
        [$parsed, $options] = ValidateValidateJsonParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/validate/json',
            body: (object) $parsed,
            options: $options,
            convert: UblDocumentValidation::class,
        );
    }

    /**
     * @api
     *
     * Validate if a Peppol ID exists in the Peppol network and retrieve supported document types. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
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
    ): BaseResponse {
        [$parsed, $options] = ValidateValidatePeppolIDParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/validate/peppol-id',
            query: Util::array_transform_keys($parsed, ['peppolID' => 'peppol_id']),
            options: $options,
            convert: ValidateValidatePeppolIDResponse::class,
        );
    }

    /**
     * @api
     *
     * Validate the correctness of a UBL document
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
    ): BaseResponse {
        [$parsed, $options] = ValidateValidateUblParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/validate/ubl',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: UblDocumentValidation::class,
        );
    }
}
