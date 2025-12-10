<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;

/**
 * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
 *
 * @see EInvoiceAPI\Services\OutboxService::listReceivedDocuments()
 *
 * @phpstan-type OutboxListReceivedDocumentsParamsShape = array{
 *   dateFrom?: \DateTimeInterface|null,
 *   dateTo?: \DateTimeInterface|null,
 *   page?: int,
 *   pageSize?: int,
 *   search?: string|null,
 *   sender?: string|null,
 *   state?: null|DocumentState|value-of<DocumentState>,
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
     * Search in invoice number, seller/buyer names.
     */
    #[Optional(nullable: true)]
    public ?string $search;

    /**
     * Filter by sender ID.
     */
    #[Optional(nullable: true)]
    public ?string $sender;

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
     * @param DocumentState|value-of<DocumentState>|null $state
     * @param DocumentType|value-of<DocumentType>|null $type
     */
    public static function with(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        ?string $sender = null,
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
    ): self {
        $self = new self;

        null !== $dateFrom && $self['dateFrom'] = $dateFrom;
        null !== $dateTo && $self['dateTo'] = $dateTo;
        null !== $page && $self['page'] = $page;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $search && $self['search'] = $search;
        null !== $sender && $self['sender'] = $sender;
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
     * Filter by sender ID.
     */
    public function withSender(?string $sender): self
    {
        $self = clone $this;
        $self['sender'] = $sender;

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
