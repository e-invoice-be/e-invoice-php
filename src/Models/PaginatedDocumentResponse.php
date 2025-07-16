<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

final class PaginatedDocumentResponse implements BaseModel
{
    use Model;

    /** @var list<DocumentResponse> $items */
    #[Api(type: new ListOf(DocumentResponse::class))]
    public array $items;

    #[Api]
    public int $page;

    #[Api('page_size')]
    public int $pageSize;

    #[Api]
    public int $pages;

    #[Api]
    public int $total;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param list<DocumentResponse> $items    `required`
     * @param int                    $page     `required`
     * @param int                    $pageSize `required`
     * @param int                    $pages    `required`
     * @param int                    $total    `required`
     */
    final public function __construct($items, $page, $pageSize, $pages, $total)
    {
        $this->constructFromArgs(func_get_args());
    }
}

PaginatedDocumentResponse::_loadMetadata();
