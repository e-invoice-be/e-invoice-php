<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\SortOrder;
use EInvoiceAPI\Mailbox\InboundEmailResponse;
use EInvoiceAPI\Mailbox\InboundEmailSortField;
use EInvoiceAPI\Mailbox\InboundEmailStatus;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\MailboxContract;

final class MailboxService implements MailboxContract
{
    /**
     * @api
     */
    public MailboxRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MailboxRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a single inbound email by ID, scoped to the caller's tenant.
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): InboundEmailResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundEmailID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of received inbound emails with filtering, search, and sorting options.
     *
     * @param int $page Page number
     * @param int $pageSize Number of items per page
     * @param bool|null $processed Filter by processing status. If not provided, returns all. Ignored when `status` is set.
     * @param string|\DateTimeInterface|null $receivedFrom Inclusive lower bound on received date (falls back to created_at when received_at is null)
     * @param string|\DateTimeInterface|null $receivedTo Inclusive upper bound on received date (falls back to created_at when received_at is null)
     * @param string|null $search Case-insensitive search across sender email, subject, message ID, and attachment filenames
     * @param 'received_at'|'created_at'|InboundEmailSortField $sortBy Field to sort by
     * @param 'asc'|'desc'|SortOrder $sortOrder Sort direction (asc/desc)
     * @param 'pending'|'success'|'failed'|InboundEmailStatus|null $status Filter by status: pending, success, or failed. Takes precedence over `processed` if both are provided.
     *
     * @return DocumentsNumberPage<InboundEmailResponse>
     *
     * @throws APIException
     */
    public function list(
        int $page = 1,
        int $pageSize = 20,
        ?bool $processed = null,
        string|\DateTimeInterface|null $receivedFrom = null,
        string|\DateTimeInterface|null $receivedTo = null,
        ?string $search = null,
        string|InboundEmailSortField $sortBy = 'received_at',
        string|SortOrder $sortOrder = 'desc',
        string|InboundEmailStatus|null $status = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentsNumberPage {
        $params = [
            'page' => $page,
            'pageSize' => $pageSize,
            'processed' => $processed,
            'receivedFrom' => $receivedFrom,
            'receivedTo' => $receivedTo,
            'search' => $search,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'status' => $status,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Download a specific attachment from an inbound email by filename. Returns the binary content with the correct Content-Type.
     *
     * @return string the raw content of the attachment
     *
     * @throws APIException
     */
    public function downloadAttachment(
        string $filename,
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null,
    ): string {
        $params = ['inboundEmailID' => $inboundEmailID];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->downloadAttachment($filename, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retry processing of a previously failed inbound email by replaying the original Postmark payload.
     *
     * @throws APIException
     */
    public function reprocess(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): InboundEmailResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reprocess($inboundEmailID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
