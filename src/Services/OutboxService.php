<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\OutboxContract;

final class OutboxService implements OutboxContract
{
    /**
     * @api
     */
    public OutboxRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OutboxRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a paginated list of draft documents with filtering options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        int $page = 1,
        int $pageSize = 20,
        ?RequestOptions $requestOptions = null
    ): DocumentsNumberPage {
        $params = Util::removeNulls(['page' => $page, 'pageSize' => $pageSize]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listDraftDocuments(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
     *
     * @param string|\DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param string|\DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender Filter by sender ID
     * @param 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null $state Filter by document state
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|DocumentType|null $type Filter by document type
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        string|\DateTimeInterface|null $dateFrom = null,
        string|\DateTimeInterface|null $dateTo = null,
        int $page = 1,
        int $pageSize = 20,
        ?string $search = null,
        ?string $sender = null,
        string|DocumentState|null $state = null,
        string|DocumentType|null $type = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        $params = Util::removeNulls(
            [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page,
                'pageSize' => $pageSize,
                'search' => $search,
                'sender' => $sender,
                'state' => $state,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listReceivedDocuments(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
