<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;

final class OutboxListReceivedDocumentsParam implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?\DateTimeInterface $dateFrom;

    #[Api(optional: true)]
    public ?\DateTimeInterface $dateTo;

    #[Api(optional: true)]
    public ?int $page;

    #[Api(optional: true)]
    public ?int $pageSize;

    #[Api(optional: true)]
    public ?string $search;

    #[Api(optional: true)]
    public ?string $sender;

    /** @var null|DocumentState::* $state */
    #[Api(optional: true)]
    public ?string $state;

    /** @var null|DocumentType::* $type */
    #[Api(optional: true)]
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
