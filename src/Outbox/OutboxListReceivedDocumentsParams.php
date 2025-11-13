<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;

/**
 * Retrieve a paginated list of sent documents with filtering options including state, type, sender, date range, and text search.
 *
 * @see EInvoiceAPI\OutboxService::listReceivedDocuments()
 *
 * @phpstan-type OutboxListReceivedDocumentsParamsShape = array{
 *   date_from?: \DateTimeInterface|null,
 *   date_to?: \DateTimeInterface|null,
 *   page?: int,
 *   page_size?: int,
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
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $date_from;

    /**
     * Filter by issue date (to).
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $date_to;

    /**
     * Page number.
     */
    #[Api(optional: true)]
    public ?int $page;

    /**
     * Number of items per page.
     */
    #[Api(optional: true)]
    public ?int $page_size;

    /**
     * Search in invoice number, seller/buyer names.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $search;

    /**
     * Filter by sender ID.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $sender;

    /**
     * Filter by document state.
     *
     * @var value-of<DocumentState>|null $state
     */
    #[Api(enum: DocumentState::class, nullable: true, optional: true)]
    public ?string $state;

    /**
     * Filter by document type.
     *
     * @var value-of<DocumentType>|null $type
     */
    #[Api(enum: DocumentType::class, nullable: true, optional: true)]
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
        ?\DateTimeInterface $date_from = null,
        ?\DateTimeInterface $date_to = null,
        ?int $page = null,
        ?int $page_size = null,
        ?string $search = null,
        ?string $sender = null,
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
    ): self {
        $obj = new self;

        null !== $date_from && $obj->date_from = $date_from;
        null !== $date_to && $obj->date_to = $date_to;
        null !== $page && $obj->page = $page;
        null !== $page_size && $obj->page_size = $page_size;
        null !== $search && $obj->search = $search;
        null !== $sender && $obj->sender = $sender;
        null !== $state && $obj['state'] = $state;
        null !== $type && $obj['type'] = $type;

        return $obj;
    }

    /**
     * Filter by issue date (from).
     */
    public function withDateFrom(?\DateTimeInterface $dateFrom): self
    {
        $obj = clone $this;
        $obj->date_from = $dateFrom;

        return $obj;
    }

    /**
     * Filter by issue date (to).
     */
    public function withDateTo(?\DateTimeInterface $dateTo): self
    {
        $obj = clone $this;
        $obj->date_to = $dateTo;

        return $obj;
    }

    /**
     * Page number.
     */
    public function withPage(int $page): self
    {
        $obj = clone $this;
        $obj->page = $page;

        return $obj;
    }

    /**
     * Number of items per page.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }

    /**
     * Search in invoice number, seller/buyer names.
     */
    public function withSearch(?string $search): self
    {
        $obj = clone $this;
        $obj->search = $search;

        return $obj;
    }

    /**
     * Filter by sender ID.
     */
    public function withSender(?string $sender): self
    {
        $obj = clone $this;
        $obj->sender = $sender;

        return $obj;
    }

    /**
     * Filter by document state.
     *
     * @param DocumentState|value-of<DocumentState>|null $state
     */
    public function withState(DocumentState|string|null $state): self
    {
        $obj = clone $this;
        $obj['state'] = $state;

        return $obj;
    }

    /**
     * Filter by document type.
     *
     * @param DocumentType|value-of<DocumentType>|null $type
     */
    public function withType(DocumentType|string|null $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
