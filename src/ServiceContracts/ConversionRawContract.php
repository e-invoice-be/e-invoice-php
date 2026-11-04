<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Conversion\ConversionCreateFromPdfParams;
use EInvoiceAPI\Conversion\DocumentCreateFromPdfTask;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type ConversionCreateFromPdfParamsShape from ConversionCreateFromPdfParams
 */
interface ConversionRawContract
{
    /**
     * @api
     *
     * @param ConversionCreateFromPdfParamsShape|ConversionCreateFromPdfParams $params
     *
     * @return BaseResponse<DocumentCreateFromPdfTask>
     *
     * @throws APIException
     */
    public function createFromPdf(
        array|ConversionCreateFromPdfParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<DocumentCreateFromPdfTask>
     *
     * @throws APIException
     */
    public function retrieve(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<DocumentNewFromPdfResponse>
     *
     * @throws APIException
     */
    public function retrieveResult(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
