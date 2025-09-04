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
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new OutboxListReceivedDocumentsParams); // set properties as needed
 * $client->outbox->listReceivedDocuments(...$params->toArray());
 * ```
 * Retrieve a paginated list of received documents with filtering options.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->outbox->listReceivedDocuments(...$params->toArray());`
 *
 * @see EInvoiceAPI\Outbox->listReceivedDocuments
 *
 * @phpstan-type outbox_list_received_documents_params = array{
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
    /** @use SdkModel<outbox_list_received_documents_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by issue date (from).
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $dateFrom;

    /**
     * Filter by issue date (to).
     */
    #[Api(nullable: true, optional: true)]
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
     * @var DocumentState::*|null $state
     */
    #[Api(enum: DocumentState::class, nullable: true, optional: true)]
    public ?string $state;

    /**
     * Filter by document type.
     *
     * @var DocumentType::*|null $type
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
     * @param DocumentState::* $state
     * @param DocumentType::* $type
     */
    public static function with(
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
    public function withDateFrom(?\DateTimeInterface $dateFrom): self
    {
        $obj = clone $this;
        $obj->dateFrom = $dateFrom;

        return $obj;
    }

    /**
     * Filter by issue date (to).
     */
    public function withDateTo(?\DateTimeInterface $dateTo): self
    {
        $obj = clone $this;
        $obj->dateTo = $dateTo;

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
        $obj->pageSize = $pageSize;

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
     * @param DocumentState::* $state
     */
    public function withState(string $state): self
    {
        $obj = clone $this;
        $obj->state = $state;

        return $obj;
    }

    /**
     * Filter by document type.
     *
     * @param DocumentType::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
