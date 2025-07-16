<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\UblDocumentValidation\Issue;

final class UblDocumentValidation implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public ?string $fileName;

    #[Api('is_valid')]
    public bool $isValid;

    /** @var list<Issue> $issues */
    #[Api(type: new ListOf(Issue::class))]
    public array $issues;

    #[Api('ubl_document', optional: true)]
    public ?string $ublDocument;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string      $id          `required`
     * @param null|string $fileName    `required`
     * @param bool        $isValid     `required`
     * @param list<Issue> $issues      `required`
     * @param null|string $ublDocument
     */
    final public function __construct(
        $id,
        $fileName,
        $isValid,
        $issues,
        $ublDocument = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

UblDocumentValidation::_loadMetadata();
