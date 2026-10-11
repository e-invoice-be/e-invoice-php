<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\SortOrder;
use EInvoiceAPI\Mailbox\InboundEmailResponse;
use EInvoiceAPI\Mailbox\InboundEmailSortField;
use EInvoiceAPI\Mailbox\InboundEmailStatus;
use EInvoiceAPI\RequestOptions;

interface MailboxContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): InboundEmailResponse;

    /**
     * @api
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
    ): DocumentsNumberPage;

    /**
     * @api
     *
     * @return string the raw content of the attachment
     *
     * @throws APIException
     */
    public function downloadAttachment(
        string $filename,
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null,
    ): string;

    /**
     * @api
     *
     * @throws APIException
     */
    public function reprocess(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): InboundEmailResponse;
}
