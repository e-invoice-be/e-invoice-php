<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortBy;
use EInvoiceAPI\Outbox\OutboxListReceivedDocumentsParams\SortOrder;

/**
 * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
 *
 * @see EInvoiceAPI\Services\OutboxService::listReceivedDocuments()
 *
 * @phpstan-type OutboxListReceivedDocumentsParamsShape = array{
 *   dateFrom?: \DateTimeInterface|null,
 *   dateTo?: \DateTimeInterface|null,
 *   page?: int|null,
 *   pageSize?: int|null,
 *   receiver?: string|null,
 *   search?: string|null,
 *   sender?: string|null,
 *   sortBy?: null|SortBy|value-of<SortBy>,
 *   sortOrder?: null|SortOrder|value-of<SortOrder>,
 *   type?: null|DocumentType|value-of<DocumentType>,
 * }
 */
final class OutboxListReceivedDocumentsParams implements BaseModel
{
    /** @use SdkModel<OutboxListReceivedDocumentsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by issue date (from).
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $dateFrom;

    /**
     * Filter by issue date (to).
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $dateTo;

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
     * Filter by receiver (customer_name, customer_email, customer_tax_id, customer_company_id, customer_id).
     */
    #[Optional(nullable: true)]
    public ?string $receiver;

    /**
     * Search in invoice number, seller/buyer names.
     */
    #[Optional(nullable: true)]
    public ?string $search;

    /**
     * (Deprecated) Filter by sender ID.
     */
    #[Optional(nullable: true)]
    public ?string $sender;

    /**
     * Field to sort by.
     *
     * @var value-of<SortBy>|null $sortBy
     */
    #[Optional(enum: SortBy::class)]
    public ?string $sortBy;

    /**
     * Sort direction (asc/desc).
     *
     * @var value-of<SortOrder>|null $sortOrder
     */
    #[Optional(enum: SortOrder::class)]
    public ?string $sortOrder;

    /**
     * Filter by document type. If not provided, returns all types.
     *
     * @var value-of<DocumentType>|null $type
     */
    #[Optional(enum: DocumentType::class, nullable: true)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param SortBy|value-of<SortBy>|null $sortBy
     * @param SortOrder|value-of<SortOrder>|null $sortOrder
     * @param DocumentType|value-of<DocumentType>|null $type
     */
    public static function with(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $receiver = null,
        ?string $search = null,
        ?string $sender = null,
        SortBy|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        DocumentType|string|null $type = null,
    ): self {
        $self = new self;

        null !== $dateFrom && $self['dateFrom'] = $dateFrom;
        null !== $dateTo && $self['dateTo'] = $dateTo;
        null !== $page && $self['page'] = $page;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $receiver && $self['receiver'] = $receiver;
        null !== $search && $self['search'] = $search;
        null !== $sender && $self['sender'] = $sender;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $sortOrder && $self['sortOrder'] = $sortOrder;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Filter by issue date (from).
     */
    public function withDateFrom(?\DateTimeInterface $dateFrom): self
    {
        $self = clone $this;
        $self['dateFrom'] = $dateFrom;

        return $self;
    }

    /**
     * Filter by issue date (to).
     */
    public function withDateTo(?\DateTimeInterface $dateTo): self
    {
        $self = clone $this;
        $self['dateTo'] = $dateTo;

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
     * Filter by receiver (customer_name, customer_email, customer_tax_id, customer_company_id, customer_id).
     */
    public function withReceiver(?string $receiver): self
    {
        $self = clone $this;
        $self['receiver'] = $receiver;

        return $self;
    }

    /**
     * Search in invoice number, seller/buyer names.
     */
    public function withSearch(?string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }

    /**
     * (Deprecated) Filter by sender ID.
     */
    public function withSender(?string $sender): self
    {
        $self = clone $this;
        $self['sender'] = $sender;

        return $self;
    }

    /**
     * Field to sort by.
     *
     * @param SortBy|value-of<SortBy> $sortBy
     */
    public function withSortBy(SortBy|string $sortBy): self
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
     * Filter by document type. If not provided, returns all types.
     *
     * @param DocumentType|value-of<DocumentType>|null $type
     */
    public function withType(DocumentType|string|null $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
