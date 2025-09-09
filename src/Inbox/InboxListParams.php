<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentType;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new InboxListParams); // set properties as needed
 * $client->inbox->list(...$params->toArray());
 * ```
 * Retrieve a paginated list of received documents with filtering options.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->inbox->list(...$params->toArray());`
 *
 * @see EInvoiceAPI\Inbox->list
 *
 * @phpstan-type inbox_list_params = array{
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
final class InboxListParams implements BaseModel
{
    /** @use SdkModel<inbox_list_params> */
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
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        ?string $sender = null,
        DocumentState|string|null $state = null,
        DocumentType|string|null $type = null,
    ): self {
        $obj = new self;

        null !== $dateFrom && $obj->dateFrom = $dateFrom;
        null !== $dateTo && $obj->dateTo = $dateTo;
        null !== $page && $obj->page = $page;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $search && $obj->search = $search;
        null !== $sender && $obj->sender = $sender;
        null !== $state && $obj->state = $state instanceof DocumentState ? $state->value : $state;
        null !== $type && $obj->type = $type instanceof DocumentType ? $type->value : $type;

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
     * @param DocumentState|value-of<DocumentState>|null $state
     */
    public function withState(DocumentState|string|null $state): self
    {
        $obj = clone $this;
        $obj->state = $state instanceof DocumentState ? $state->value : $state;

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
        $obj->type = $type instanceof DocumentType ? $type->value : $type;

        return $obj;
    }
}
