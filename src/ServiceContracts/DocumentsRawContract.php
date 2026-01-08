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

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
interface DocumentsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DocumentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function create(
        array|DocumentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DocumentCreateFromPdfParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentNewFromPdfResponse>
     *
     * @throws APIException
     */
    public function createFromPdf(
        array|DocumentCreateFromPdfParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DocumentSendParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        array|DocumentSendParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
