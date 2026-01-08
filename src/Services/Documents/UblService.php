<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\Documents\UblContract;

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class UblService implements UblContract
{
    /**
     * @api
     */
    public UblRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UblRawService($client);
    }

    /**
     * @api
     *
     * Create a new invoice or credit note from a UBL file
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createFromUbl(
        string $file,
        RequestOptions|array|null $requestOptions = null
    ): DocumentResponse {
        $params = Util::removeNulls(['file' => $file]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createFromUbl(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the UBL for an invoice or credit note
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): UblGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
