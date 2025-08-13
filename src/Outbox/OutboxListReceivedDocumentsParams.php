<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Inbox\DocumentState;

/**
 * Retrieve a paginated list of received documents with filtering options.
 *
 * @phpstan-type list_received_documents_params = array{
 *   dateFrom?: \DateTimeInterface|null,
 *   dateTo?: \DateTimeInterface|null,
 *   page?: int,
 *   pageSize?: int,
 *   search?: string|null,
 *   sender?: string|null,
 *   state?: DocumentState::*,
 *   type?: DocumentType::*,
 * }
 */
final class OutboxListReceivedDocumentsParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Filter by issue date (from).
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $dateFrom;

    /**
     * Filter by issue date (to).
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $dateTo;

    /**
     * Page number.
     */
    #[Api(optional: true)]
    public ?int $page;

    /**
     * Number of items per page.
     */
    #[Api(optional: true)]
    public ?int $pageSize;

    /**
     * Search in invoice number, seller/buyer names.
     */
    #[Api(optional: true)]
    public ?string $search;

    /**
     * Filter by sender ID.
     */
    #[Api(optional: true)]
    public ?string $sender;

    /**
     * Filter by document state.
     *
     * @var null|DocumentState::* $state
     */
    #[Api(enum: DocumentState::class, optional: true)]
    public ?string $state;

    /**
     * Filter by document type.
     *
     * @var null|DocumentType::* $type
     */
    #[Api(enum: DocumentType::class, optional: true)]
    public ?string $type;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DocumentState::* $state
     * @param DocumentType::* $type
     */
    public static function from(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        ?string $sender = null,
        ?string $state = null,
        ?string $type = null,
    ): self {
        $obj = new self;

        null !== $dateFrom && $obj->dateFrom = $dateFrom;
        null !== $dateTo && $obj->dateTo = $dateTo;
        null !== $page && $obj->page = $page;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $search && $obj->search = $search;
        null !== $sender && $obj->sender = $sender;
        null !== $state && $obj->state = $state;
        null !== $type && $obj->type = $type;

        return $obj;
    }

    /**
     * Filter by issue date (from).
     */
    public function setDateFrom(?\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Filter by issue date (to).
     */
    public function setDateTo(?\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Page number.
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Number of items per page.
     */
    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * Search in invoice number, seller/buyer names.
     */
    public function setSearch(?string $search): self
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Filter by sender ID.
     */
    public function setSender(?string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Filter by document state.
     *
     * @param DocumentState::* $state
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Filter by document type.
     *
     * @param DocumentType::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
