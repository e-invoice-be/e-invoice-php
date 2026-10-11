<?php

declare(strict_types=1);

namespace EInvoiceAPI\Drafts;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Inbox\SortField;
use EInvoiceAPI\Inbox\SortOrder;

/**
 * Retrieve a paginated list of draft documents with filtering options including state and text search.
 *
 * @see EInvoiceAPI\Services\DraftsService::list()
 *
 * @phpstan-type DraftListParamsShape = array{
 *   dateFrom?: \DateTimeInterface|null,
 *   dateTo?: \DateTimeInterface|null,
 *   page?: int,
 *   pageSize?: int,
 *   search?: string|null,
 *   sortBy?: SortField|value-of<SortField>,
 *   sortOrder?: SortOrder|value-of<SortOrder>,
 *   state?: null|DocumentState|value-of<DocumentState>,
 *   type?: null|DocumentType|value-of<DocumentType>,
 * }
 */
final class DraftListParams implements BaseModel
{
    /** @use SdkModel<DraftListParamsShape> */
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
     * Search in invoice number, seller/buyer names.
     */
    #[Optional(nullable: true)]
    public ?string $search;

    /**
     * Field to sort by.
     *
     * @var value-of<SortField>|null $sortBy
     */
    #[Optional(enum: SortField::class)]
    public ?string $sortBy;

    /**
     * Sort direction (asc/desc).
     *
     * @var value-of<SortOrder>|null $sortOrder
     */
    #[Optional(enum: SortOrder::class)]
    public ?string $sortOrder;

    /**
     * Filter by document state. By default return all states (DRAFT, TRANSIT, FAILED).
     *
     * @var value-of<DocumentState>|null $state
     */
    #[Optional(enum: DocumentState::class, nullable: true)]
    public ?string $state;

    /**
     * Filter by document type.
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
     * @param SortField|value-of<SortField>|null $sortBy
     * @param SortOrder|value-of<SortOrder>|null $sortOrder
     * @param DocumentState|value-of<DocumentState>|null $state
     * @param DocumentType|value-of<DocumentType>|null $type
     */
    public static function with(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        SortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
    ): self {
        $self = new self;

        null !== $dateFrom && $self['dateFrom'] = $dateFrom;
        null !== $dateTo && $self['dateTo'] = $dateTo;
        null !== $page && $self['page'] = $page;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $search && $self['search'] = $search;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $sortOrder && $self['sortOrder'] = $sortOrder;
        null !== $state && $self['state'] = $state;
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
     * Search in invoice number, seller/buyer names.
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
     * @param SortField|value-of<SortField> $sortBy
     */
    public function withSortBy(SortField|string $sortBy): self
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
     * Filter by document state. By default return all states (DRAFT, TRANSIT, FAILED).
     *
     * @param DocumentState|value-of<DocumentState>|null $state
     */
    public function withState(DocumentState|string|null $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * Filter by document type.
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
