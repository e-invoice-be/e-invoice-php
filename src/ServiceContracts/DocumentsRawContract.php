<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentCreateFromPdfParams;
use EInvoiceAPI\Documents\DocumentCreateParams;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentSendParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Validate\UblDocumentValidation;

interface DocumentsRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|DocumentCreateParams $params
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function create(
        array|DocumentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<DocumentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|DocumentCreateFromPdfParams $params
     *
     * @return BaseResponse<DocumentNewFromPdfResponse>
     *
     * @throws APIException
     */
    public function createFromPdf(
        array|DocumentCreateFromPdfParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|DocumentSendParams $params
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        array|DocumentSendParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
