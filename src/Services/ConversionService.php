<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Conversion\DocumentCreateFromPdfTask;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\ConversionContract;

final class ConversionService implements ConversionContract
{
    /**
     * @api
     */
    public ConversionRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ConversionRawService($client);
    }

    /**
     * @api
     *
     * Convert a PDF to a document
     *
     * @throws APIException
     */
    public function createFromPdf(
        string|FileParam $file,
        ?RequestOptions $requestOptions = null
    ): DocumentCreateFromPdfTask {
        $params = ['file' => $file];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createFromPdf(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the status of a PDF conversion task
     *
     * @throws APIException
     */
    public function retrieve(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): DocumentCreateFromPdfTask {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($taskID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the result of a PDF conversion task
     *
     * @throws APIException
     */
    public function retrieveResult(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): DocumentNewFromPdfResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveResult($taskID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
