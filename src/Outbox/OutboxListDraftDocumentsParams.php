<?php

declare(strict_types=1);

namespace EInvoiceAPI\Outbox;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of draft documents with filtering options.
 *
 * @see EInvoiceAPI\Services\OutboxService::listDraftDocuments()
 *
 * @phpstan-type OutboxListDraftDocumentsParamsShape = array{
 *   page?: int, pageSize?: int
 * }
 */
final class OutboxListDraftDocumentsParams implements BaseModel
{
    /** @use SdkModel<OutboxListDraftDocumentsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page number.
     */
    #[Optional]
    public ?int $page;

    /**
     * Number of items per page.
     */
    #[Optional]
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
        $self = new self;

        null !== $page && $self['page'] = $page;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Page number.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Number of items per page.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
