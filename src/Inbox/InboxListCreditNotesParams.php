<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of received credit notes with filtering options.
 *
 * @see EInvoiceAPI\Services\InboxService::listCreditNotes()
 *
 * @phpstan-type InboxListCreditNotesParamsShape = array{
 *   page?: int,
 *   pageSize?: int,
 *   sortBy?: SortField|value-of<SortField>,
 *   sortOrder?: SortOrder|value-of<SortOrder>,
 * }
 */
final class InboxListCreditNotesParams implements BaseModel
{
    /** @use SdkModel<InboxListCreditNotesParamsShape> */
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
     */
    public static function with(
        ?int $page = null,
        ?int $pageSize = null,
        SortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
    ): self {
        $self = new self;

        null !== $page && $self['page'] = $page;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $sortOrder && $self['sortOrder'] = $sortOrder;

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
}
