<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\Ubl\UblCreateFromUblParams;
use EInvoiceAPI\Documents\Ubl\UblGetResponse;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\Documents\UblContract;

final class UblService implements UblContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new invoice or credit note from a UBL file
     *
     * @param array{file: string}|UblCreateFromUblParams $params
     *
     * @throws APIException
     */
    public function createFromUbl(
        array|UblCreateFromUblParams $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = UblCreateFromUblParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DocumentResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'api/documents/ubl',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: DocumentResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the UBL for an invoice or credit note
     *
     * @throws APIException
     */
    public function get(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblGetResponse {
        /** @var BaseResponse<UblGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/ubl', $documentID],
            options: $requestOptions,
            convert: UblGetResponse::class,
        );

        return $response->parse();
    }
}
