<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Inbox\SortOrder;
use EInvoiceAPI\Mailbox\InboundEmailResponse;
use EInvoiceAPI\Mailbox\InboundEmailSortField;
use EInvoiceAPI\Mailbox\InboundEmailStatus;
use EInvoiceAPI\Mailbox\MailboxDownloadAttachmentParams;
use EInvoiceAPI\Mailbox\MailboxListParams;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\MailboxRawContract;

final class MailboxRawService implements MailboxRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a single inbound email by ID, scoped to the caller's tenant.
     *
     * @return BaseResponse<InboundEmailResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/mailbox/%1$s', $inboundEmailID],
            options: $requestOptions,
            convert: InboundEmailResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of received inbound emails with filtering, search, and sorting options.
     *
     * @param array{
     *   page?: int,
     *   pageSize?: int,
     *   processed?: bool|null,
     *   receivedFrom?: string|\DateTimeInterface|null,
     *   receivedTo?: string|\DateTimeInterface|null,
     *   search?: string|null,
     *   sortBy?: 'received_at'|'created_at'|InboundEmailSortField,
     *   sortOrder?: 'asc'|'desc'|SortOrder,
     *   status?: 'pending'|'success'|'failed'|InboundEmailStatus|null,
     * }|MailboxListParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<InboundEmailResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|MailboxListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MailboxListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/mailbox/',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'pageSize' => 'page_size',
                    'receivedFrom' => 'received_from',
                    'receivedTo' => 'received_to',
                    'sortBy' => 'sort_by',
                    'sortOrder' => 'sort_order',
                ],
            ),
            options: $options,
            convert: InboundEmailResponse::class,
            page: DocumentsNumberPage::class,
        );
    }

    /**
     * @api
     *
     * Download a specific attachment from an inbound email by filename. Returns the binary content with the correct Content-Type.
     *
     * @param array{inboundEmailID: string}|MailboxDownloadAttachmentParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function downloadAttachment(
        string $filename,
        array|MailboxDownloadAttachmentParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MailboxDownloadAttachmentParams::parseRequest(
            $params,
            $requestOptions,
        );
        $inboundEmailID = $parsed['inboundEmailID'];
        unset($parsed['inboundEmailID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/mailbox/%1$s/attachments/%2$s', $inboundEmailID, $filename],
            headers: ['Accept' => '*/*'],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * Retry processing of a previously failed inbound email by replaying the original Postmark payload.
     *
     * @return BaseResponse<InboundEmailResponse>
     *
     * @throws APIException
     */
    public function reprocess(
        string $inboundEmailID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['api/mailbox/%1$s/reprocess', $inboundEmailID],
            options: $requestOptions,
            convert: InboundEmailResponse::class,
        );
    }
}
