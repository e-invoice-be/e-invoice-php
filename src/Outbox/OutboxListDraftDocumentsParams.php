<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new OutboxListDraftDocumentsParams); // set properties as needed
 * $client->outbox->listDraftDocuments(...$params->toArray());
 * ```
 * Retrieve a paginated list of draft documents with filtering options.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->outbox->listDraftDocuments(...$params->toArray());`
 *
 * @see EInvoiceAPI\Outbox->listDraftDocuments
 *
 * @phpstan-type outbox_list_draft_documents_params = array{
 *   page?: int, pageSize?: int
 * }
 */
final class OutboxListDraftDocumentsParams implements BaseModel
{
    /** @use SdkModel<outbox_list_draft_documents_params> */
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
    public ?int $pageSize;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $page = null, ?int $pageSize = null): self
    {
        $obj = new self;

        null !== $page && $obj->page = $page;
        null !== $pageSize && $obj->pageSize = $pageSize;

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
}
