<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Conversion\ConversionCreateFromPdfParams;
use EInvoiceAPI\Conversion\DocumentCreateFromPdfTask;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\ConversionRawContract;

final class ConversionRawService implements ConversionRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Convert a PDF to a document
     *
     * @param array{file: string|FileParam}|ConversionCreateFromPdfParams $params
     *
     * @return BaseResponse<DocumentCreateFromPdfTask>
     *
     * @throws APIException
     */
    public function createFromPdf(
        array|ConversionCreateFromPdfParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ConversionCreateFromPdfParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/conversion/pdf',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: DocumentCreateFromPdfTask::class,
        );
    }

    /**
     * @api
     *
     * Get the status of a PDF conversion task
     *
     * @return BaseResponse<DocumentCreateFromPdfTask>
     *
     * @throws APIException
     */
    public function retrieve(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/conversion/pdf/%1$s', $taskID],
            options: $requestOptions,
            convert: DocumentCreateFromPdfTask::class,
        );
    }

    /**
     * @api
     *
     * Get the result of a PDF conversion task
     *
     * @return BaseResponse<DocumentNewFromPdfResponse>
     *
     * @throws APIException
     */
    public function retrieveResult(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/conversion/pdf/%1$s/result', $taskID],
            options: $requestOptions,
            convert: DocumentNewFromPdfResponse::class,
        );
    }
}
