<?php

declare(strict_types=1);

namespace EInvoiceAPI\Mailbox;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Inbox\SortOrder;

/**
 * Retrieve a paginated list of received inbound emails with filtering, search, and sorting options.
 *
 * @see EInvoiceAPI\Services\MailboxService::list()
 *
 * @phpstan-type MailboxListParamsShape = array{
 *   page?: int,
 *   pageSize?: int,
 *   processed?: bool|null,
 *   receivedFrom?: \DateTimeInterface|null,
 *   receivedTo?: \DateTimeInterface|null,
 *   search?: string|null,
 *   sortBy?: InboundEmailSortField|value-of<InboundEmailSortField>,
 *   sortOrder?: SortOrder|value-of<SortOrder>,
 *   status?: null|InboundEmailStatus|value-of<InboundEmailStatus>,
 * }
 */
final class MailboxListParams implements BaseModel
{
    /** @use SdkModel<MailboxListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page number.
     */
    #[Optional]
    public ?int $page;

    /**
     * Number of items per page.
     */
    #[Optional]
    public ?int $pageSize;

    /**
     * Filter by processing status. If not provided, returns all. Ignored when `status` is set.
     */
    #[Optional(nullable: true)]
    public ?bool $processed;

    /**
     * Inclusive lower bound on received date (falls back to created_at when received_at is null).
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $receivedFrom;

    /**
     * Inclusive upper bound on received date (falls back to created_at when received_at is null).
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $receivedTo;

    /**
     * Case-insensitive search across sender email, subject, message ID, and attachment filenames.
     */
    #[Optional(nullable: true)]
    public ?string $search;

    /**
     * Field to sort by.
     *
     * @var value-of<InboundEmailSortField>|null $sortBy
     */
    #[Optional(enum: InboundEmailSortField::class)]
    public ?string $sortBy;

    /**
     * Sort direction (asc/desc).
     *
     * @var value-of<SortOrder>|null $sortOrder
     */
    #[Optional(enum: SortOrder::class)]
    public ?string $sortOrder;

    /**
     * Filter by status: pending, success, or failed. Takes precedence over `processed` if both are provided.
     *
     * @var value-of<InboundEmailStatus>|null $status
     */
    #[Optional(enum: InboundEmailStatus::class, nullable: true)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param InboundEmailSortField|value-of<InboundEmailSortField>|null $sortBy
     * @param SortOrder|value-of<SortOrder>|null $sortOrder
     * @param InboundEmailStatus|value-of<InboundEmailStatus>|null $status
     */
    public static function with(
        ?int $page = null,
        ?int $pageSize = null,
        ?bool $processed = null,
        ?\DateTimeInterface $receivedFrom = null,
        ?\DateTimeInterface $receivedTo = null,
        ?string $search = null,
        InboundEmailSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        InboundEmailStatus|string|null $status = null,
    ): self {
        $self = new self;

        null !== $page && $self['page'] = $page;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $processed && $self['processed'] = $processed;
        null !== $receivedFrom && $self['receivedFrom'] = $receivedFrom;
        null !== $receivedTo && $self['receivedTo'] = $receivedTo;
        null !== $search && $self['search'] = $search;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $sortOrder && $self['sortOrder'] = $sortOrder;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Page number.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Number of items per page.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by processing status. If not provided, returns all. Ignored when `status` is set.
     */
    public function withProcessed(?bool $processed): self
    {
        $self = clone $this;
        $self['processed'] = $processed;

        return $self;
    }

    /**
     * Inclusive lower bound on received date (falls back to created_at when received_at is null).
     */
    public function withReceivedFrom(?\DateTimeInterface $receivedFrom): self
    {
        $self = clone $this;
        $self['receivedFrom'] = $receivedFrom;

        return $self;
    }

    /**
     * Inclusive upper bound on received date (falls back to created_at when received_at is null).
     */
    public function withReceivedTo(?\DateTimeInterface $receivedTo): self
    {
        $self = clone $this;
        $self['receivedTo'] = $receivedTo;

        return $self;
    }

    /**
     * Case-insensitive search across sender email, subject, message ID, and attachment filenames.
     */
    public function withSearch(?string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }

    /**
     * Field to sort by.
     *
     * @param InboundEmailSortField|value-of<InboundEmailSortField> $sortBy
     */
    public function withSortBy(InboundEmailSortField|string $sortBy): self
    {
        $self = clone $this;
        $self['sortBy'] = $sortBy;

        return $self;
    }

    /**
     * Sort direction (asc/desc).
     *
     * @param SortOrder|value-of<SortOrder> $sortOrder
     */
    public function withSortOrder(SortOrder|string $sortOrder): self
    {
        $self = clone $this;
        $self['sortOrder'] = $sortOrder;

        return $self;
    }

    /**
     * Filter by status: pending, success, or failed. Takes precedence over `processed` if both are provided.
     *
     * @param InboundEmailStatus|value-of<InboundEmailStatus>|null $status
     */
    public function withStatus(InboundEmailStatus|string|null $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
