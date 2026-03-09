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

/**
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
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
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listDraftDocuments(
        int $page = 1,
        int $pageSize = 20,
        RequestOptions|array|null $requestOptions = null,
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
     * @param \DateTimeInterface|null $dateFrom Filter by issue date (from)
     * @param \DateTimeInterface|null $dateTo Filter by issue date (to)
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param string|null $search Search in invoice number, seller/buyer names
     * @param string|null $sender Filter by sender ID
     * @param DocumentState|value-of<DocumentState>|null $state Filter by document state
     * @param DocumentType|value-of<DocumentType>|null $type Filter by document type
     * @param RequestOpts|null $requestOptions
     *
     * @return DocumentsNumberPage<DocumentResponse>
     *
     * @throws APIException
     */
    public function listReceivedDocuments(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        int $page = 1,
        int $pageSize = 20,
        ?string $search = null,
        ?string $sender = null,
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
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
