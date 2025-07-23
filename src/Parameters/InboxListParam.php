<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;

/**
 * Retrieve a paginated list of received documents with filtering options.
 *
 * @phpstan-type list_params = array{
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
final class InboxListParam implements BaseModel
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

    /**
     * You must use named parameters to construct this object.
     *
     * @param DocumentState::* $state
     * @param DocumentType::*  $type
     */
    final public function __construct(
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        ?string $sender = null,
        ?string $state = null,
        ?string $type = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        null !== $dateFrom && $this->dateFrom = $dateFrom;
        null !== $dateTo && $this->dateTo = $dateTo;
        null !== $page && $this->page = $page;
        null !== $pageSize && $this->pageSize = $pageSize;
        null !== $search && $this->search = $search;
        null !== $sender && $this->sender = $sender;
        null !== $state && $this->state = $state;
        null !== $type && $this->type = $type;
    }
}
