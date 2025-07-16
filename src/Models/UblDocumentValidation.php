<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
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
     * You must use named parameters to construct this object.
     *
     * @param list<Issue> $issues
     */
    final public function __construct(
        string $id,
        ?string $fileName,
        bool $isValid,
        array $issues,
        ?string $ublDocument = null,
    ) {
        $this->id = $id;
        $this->fileName = $fileName;
        $this->isValid = $isValid;
        $this->issues = $issues;
        $this->ublDocument = $ublDocument;
    }
}

UblDocumentValidation::_loadMetadata();
