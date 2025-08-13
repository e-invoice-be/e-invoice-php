<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of draft documents with filtering options.
 *
 * @phpstan-type list_draft_documents_params = array{page?: int, pageSize?: int}
 */
final class OutboxListDraftDocumentsParams implements BaseModel
{
    use Model;
    use Params;

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

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(?int $page = null, ?int $pageSize = null): self
    {
        $obj = new self;

        null !== $page && $obj->page = $page;
        null !== $pageSize && $obj->pageSize = $pageSize;

        return $obj;
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
}
