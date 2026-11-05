<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentCreateFromPdfParams;
use EInvoiceAPI\Documents\DocumentCreateParams;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentSendParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\DocumentsRawContract;
use EInvoiceAPI\Validate\UblDocumentValidation;

/**
 * @phpstan-import-type DocumentCreateParamsShape from DocumentCreateParams
 * @phpstan-import-type DocumentCreateFromPdfParamsShape from DocumentCreateFromPdfParams
 * @phpstan-import-type DocumentSendParamsShape from DocumentSendParams
 */
final class DocumentsRawService implements DocumentsRawContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new invoice or credit note
     *
     * @param DocumentCreateParamsShape|DocumentCreateParams $params
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function create(
        array|DocumentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = DocumentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['constructPdf']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/documents/',
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                ['constructPdf' => 'construct_pdf'],
            ),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Get an invoice or credit note by ID
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete an invoice or credit note
     *
     * @return BaseResponse<DocumentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
     *
     * @param DocumentCreateFromPdfParamsShape|DocumentCreateFromPdfParams $params
     *
     * @return BaseResponse<DocumentNewFromPdfResponse>
     *
     * @throws APIException
     */
    public function createFromPdf(
        array|DocumentCreateFromPdfParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DocumentCreateFromPdfParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['customerTaxID', 'vendorTaxID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/documents/pdf',
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                [
                    'customerTaxID' => 'customer_tax_id', 'vendorTaxID' => 'vendor_tax_id',
                ],
            ),
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: DocumentNewFromPdfResponse::class,
        );
    }

    /**
     * @api
     *
     * Get the lifecycle events stated about an invoice or credit note after creation (Peppol Message Level and Invoice Responses, partner status events), oldest first. Each event carries a route-agnostic canonical status next to the untouched native code of its source; native codes without a canonical equivalent have canonical_status null.
     *
     * @return BaseResponse<DocumentGetLifecycleResponse>
     *
     * @throws APIException
     */
    public function retrieveLifecycle(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/lifecycle', $documentID],
            options: $requestOptions,
            convert: DocumentGetLifecycleResponse::class,
        );
    }

    /**
     * @api
     *
     * Get the timeline of events for an invoice or credit note, including creation, validation, transmission, and delivery events
     *
     * @return BaseResponse<DocumentGetTimelineResponse>
     *
     * @throws APIException
     */
    public function retrieveTimeline(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s/timeline', $documentID],
            options: $requestOptions,
            convert: DocumentGetTimelineResponse::class,
        );
    }

    /**
     * @api
     *
     * Send an invoice or credit note via Peppol. By default, the sender and receiver Peppol IDs are derived from the company (tax) IDs in the document, regardless of whether the document was created from a UBL with a different endpoint ID. To explicitly set the sender or receiver Peppol ID, provide them via the query parameters (sender_peppol_scheme, sender_peppol_id, receiver_peppol_scheme, receiver_peppol_id).
     *
     * @param DocumentSendParamsShape|DocumentSendParams $params
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        array|DocumentSendParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DocumentSendParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'receiverPeppolID' => 'receiver_peppol_id',
                    'receiverPeppolScheme' => 'receiver_peppol_scheme',
                    'senderPeppolID' => 'sender_peppol_id',
                    'senderPeppolScheme' => 'sender_peppol_scheme',
                ],
            ),
            options: $options,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Validate a UBL document according to Peppol BIS Billing 3.0
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/validate', $documentID],
            options: $requestOptions,
            convert: UblDocumentValidation::class,
        );
    }
}
