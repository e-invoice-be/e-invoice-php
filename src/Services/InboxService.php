<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Inbox\InboxListCreditNotesParams;
use EInvoiceAPI\Inbox\InboxListInvoicesParams;
use EInvoiceAPI\Inbox\InboxListParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\InboxContract;

final class InboxService implements InboxContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a paginated list of received documents with filtering options including state, type, sender, date range, and text search.
     *
     * @param array{
     *   dateFrom?: string|\DateTimeInterface|null,
     *   dateTo?: string|\DateTimeInterface|null,
     *   page?: int,
     *   pageSize?: int,
     *   search?: string|null,
     *   sender?: string|null,
     *   state?: 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null,
     *   type?: 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|DocumentType|null,
     * }|InboxListParams $params
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function list(
        array|InboxListParams $params,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        [$parsed, $options] = InboxListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DocumentsNumberPage<DocumentResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'api/inbox/',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'dateFrom' => 'date_from',
                    'dateTo' => 'date_to',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of received credit notes with filtering options.
     *
     * @param array{page?: int, pageSize?: int}|InboxListCreditNotesParams $params
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listCreditNotes(
        array|InboxListCreditNotesParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        [$parsed, $options] = InboxListCreditNotesParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DocumentsNumberPage<DocumentResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'api/inbox/credit-notes',
            query: Util::array_transform_keys($parsed, ['pageSize' => 'page_size']),
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of received invoices with filtering options.
     *
     * @param array{page?: int, pageSize?: int}|InboxListInvoicesParams $params
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listInvoices(
        array|InboxListInvoicesParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        [$parsed, $options] = InboxListInvoicesParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DocumentsNumberPage<DocumentResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'api/inbox/invoices',
            query: Util::array_transform_keys($parsed, ['pageSize' => 'page_size']),
            options: $options,
            convert: DocumentResponse::class,
            page: DocumentsNumberPage::class,
        );

        return $response->parse();
    }
}
