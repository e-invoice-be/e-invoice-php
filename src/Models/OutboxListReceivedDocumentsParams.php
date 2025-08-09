<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

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
    public static function new(
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
}
