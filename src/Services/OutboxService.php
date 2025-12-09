<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\OutboxContract;

final class OutboxService implements OutboxContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options.
     *
     * @param array{page?: int, page_size?: int}|OutboxListDraftDocumentsParams $params
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        array|OutboxListDraftDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        [$parsed, $options] = OutboxListDraftDocumentsParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DocumentsNumberPage<DocumentResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'api/outbox/drafts',
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
     *
     * @param array{
     *   date_from?: string|\DateTimeInterface|null,
     *   date_to?: string|\DateTimeInterface|null,
     *   page?: int,
     *   page_size?: int,
     *   search?: string|null,
     *   sender?: string|null,
     *   state?: 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null,
     *   type?: 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|DocumentType|null,
     * }|OutboxListReceivedDocumentsParams $params
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        array|OutboxListReceivedDocumentsParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        [$parsed, $options] = OutboxListReceivedDocumentsParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DocumentsNumberPage<DocumentResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'api/outbox/',
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );

        return $response->parse();
    }
}
