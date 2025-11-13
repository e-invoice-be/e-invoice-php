<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of received credit notes with filtering options.
 *
 * @see EInvoiceAPI\InboxService::listCreditNotes()
 *
 * @phpstan-type InboxListCreditNotesParamsShape = array{
 *   page?: int, page_size?: int
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
    #[Api(optional: true)]
    public ?int $page;

    /**
     * Number of items per page.
     */
    #[Api(optional: true)]
    public ?int $page_size;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $page = null, ?int $page_size = null): self
    {
        $obj = new self;

        null !== $page && $obj->page = $page;
        null !== $page_size && $obj->page_size = $page_size;

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
}
