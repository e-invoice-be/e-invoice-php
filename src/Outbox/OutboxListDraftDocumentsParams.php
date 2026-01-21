<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams\SortBy;
use EInvoiceAPI\Outbox\OutboxListDraftDocumentsParams\SortOrder;

/**
 * Retrieve a paginated list of draft documents with filtering options including state and text search.
 *
 * @deprecated
 * @see EInvoiceAPI\Services\OutboxService::listDraftDocuments()
 *
 * @phpstan-type OutboxListDraftDocumentsParamsShape = array{
 *   page?: int|null,
 *   pageSize?: int|null,
 *   search?: string|null,
 *   sortBy?: null|SortBy|value-of<SortBy>,
 *   sortOrder?: null|SortOrder|value-of<SortOrder>,
 *   state?: null|DocumentState|value-of<DocumentState>,
 *   type?: null|DocumentType|value-of<DocumentType>,
 * }
 */
final class OutboxListDraftDocumentsParams implements BaseModel
{
    /** @use SdkModel<OutboxListDraftDocumentsParamsShape> */
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
     * Search in invoice number, seller/buyer names.
     */
    #[Optional(nullable: true)]
    public ?string $search;

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
     * Filter by document state.
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
     * @param SortBy|value-of<SortBy>|null $sortBy
     * @param SortOrder|value-of<SortOrder>|null $sortOrder
     * @param DocumentState|value-of<DocumentState>|null $state
     * @param DocumentType|value-of<DocumentType>|null $type
     */
    public static function with(
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        SortBy|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
    ): self {
        $self = new self;

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
     * Filter by document state.
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
