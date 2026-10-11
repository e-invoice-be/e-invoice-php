<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Conversion\DocumentCreateFromPdfTask;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\RequestOptions;

interface ConversionContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function createFromPdf(
        string|FileParam $file,
        ?RequestOptions $requestOptions = null
    ): DocumentCreateFromPdfTask;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): DocumentCreateFromPdfTask;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveResult(
        string $taskID,
        ?RequestOptions $requestOptions = null
    ): DocumentNewFromPdfResponse;
}
